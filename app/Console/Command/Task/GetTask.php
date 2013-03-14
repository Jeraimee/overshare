<?php
class GetTask extends Shell {

  public $uses = array('Post');

  public function execute()
  {
    $username = Configure::read('Email.username');
    $password = Configure::read('Email.password');

    if (!$mbox = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}Inbox', $username, $password)) {
      $this->out('Failed to open mailbox. Error: ' . imap_last_error());
      return;
    }

    if (!$headers = imap_headers($mbox)) {
      return;
    }

    $this->out('Found ' . number_format(count($headers)) . ' messages to parse.');

    $i = 0;

    foreach ($headers as $header) {
      $i++;

      $this->Post->create();
      $data = array('Post' => array());

      // Will return many infos about current email
      // Use var_dump($info) to check content
      $info  = imap_headerinfo($mbox, $i);
      $msgid = trim($info->Msgno);

      $data['Post']['title'] = trim($info->subject);

      // Gets the current email structure (including parts)
      // Use var_dump($structure) to check it out
      $structure = imap_fetchstructure($mbox, $msgid);

      if ($structure->type == 0) {
        // Plain text message, just grab it

        $data['Post']['body'] = make_links(trim(imap_qprint(imap_body($mbox, $i))));

      }
      else {

        // Getting attachments
        // Will return an array with all included files
        // Also works with inline attachments
        $attachments = get_attachments($structure);

        $data['Post']['body'] = trim(imap_qprint(imap_body($mbox, $i)));

        // You are now able to get attachments' raw content
        foreach ($attachments as $k => $at) {
          $filename = WWW_ROOT . Configure::read('attachments_dir') . DS .$at['filename'];
          $content = imap_fetchbody($mbox, $msgid, $at['part']);

          $stripped_content = trim(imap_qprint($content));

          if ($stripped_content == $data['Post']['body']) {
            $data['Post']['body'] = make_src_body($at['filename']);
          }

          if ($content !== false && strlen($content) > 0 && $content != '') {
            switch ($at['encoding']) {
              case '3':
                $content = base64_decode($content);
              break;
              case '4':
                $content = quoted_printable_decode($content);
              break;
            }

            file_put_contents($filename, $content);
          }
        }

      }

      if ($this->Post->save($data)) {
        $this->out('Created post.');
        //imap_delete($mbox, $i);
      }
      else {
        $this->out('Failed to create post.');
      }

    }

    // Shutting down
    imap_close($mbox, CL_EXPUNGE);
  }

}

function make_links($text)
{
  $text = preg_replace('%(((f|ht){1}tp://)[-a-zA-^Z0-9@:\%_\+.~#?&//=]+)%i',
  '<a href="\\1">\\1</a>', $text);
  $text = preg_replace('%([[:space:]()[{}])(www.[-a-zA-Z0-9@:\%_\+.~#?&//=]+)%i',
  '\\1<a href="http://\\2">\\2</a>', $text);

  return $text;
}

function make_src_body($filename)
{
  $src = '/' . Configure::read('attachments_dir') . '/' . $filename;
  return "<img src=\"{$src}\" alt=\"{$filename}\" title=\"{$filename}\" />";
}

/**
 * Gets all attachments
 * Including inline images or such
 * @author: Axel de Vignon
 * @param $content: the email structure
 * @param $part: not to be set, used for recursivity
 * @return array(type, encoding, part, filename)
 */

function get_attachments($content, $part = null, $skip_parts = false)
{
 static $results;

 // First round, emptying results
 if (is_null($part)) {
   $results = array();
 }
 else {
   // Removing first dot (.)
   if (substr($part, 0, 1) == '.') {
     $part = substr($part, 1);
   }
 }

 // Saving the current part
 $actualpart = $part;
 // Split on the "."
 $split = explode('.', $actualpart);

 // Skipping parts
 if (is_array($skip_parts)) {
   foreach ($skip_parts as $p) {
     // Removing a row off the array
      array_splice($split, $p, 1);
   }
   // Rebuilding part string
   $actualpart = implode('.', $split);
 }

 // Each time we get the RFC822 subtype, we skip
 // this part.
 if (strtolower($content->subtype) == 'rfc822') {
   // Never used before, initializing
   if (!is_array($skip_parts)) {
     $skip_parts = array();
   }
   // Adding this part into the skip list
   array_push($skip_parts, count($split));
 }

 // Checking ifdparameters
 if (isset($content->ifdparameters) && $content->ifdparameters == 1 && isset($content->dparameters) && is_array($content->dparameters)) {
   foreach ($content->dparameters as $object) {
     if (isset($object->attribute) && preg_match('~filename~i', $object->attribute)) {
       $results[] = array('type'          => (isset($content->subtype)) ? $content->subtype : '',
                          'encoding'      => $content->encoding,
                          'part'          => empty($actualpart) ? 1 : $actualpart,
                          'filename'      => $object->value);
     }
   }
 }
 else if (isset($content->ifparameters) && $content->ifparameters == 1 && isset($content->parameters) && is_array($content->parameters)) {
   foreach ($content->parameters as $object) {
     if (isset($object->attribute) && preg_match('~name~i', $object->attribute)) {
       $results[] = array('type'          => (isset($content->subtype)) ? $content->subtype : '',
                          'encoding'      => $content->encoding,
                          'part'          => empty($actualpart) ? 1 : $actualpart,
                          'filename'      => $object->value);
     }
   }
 }

 // Recursivity
 if (isset($content->parts) && count($content->parts) > 0) {
   // Other parts into content
    foreach ($content->parts as $key => $parts) {
      get_attachments($parts, ($part.'.'.($key + 1)), $skip_parts);
    }
 }
 return $results;
}
