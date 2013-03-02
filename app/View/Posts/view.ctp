<?php $this->set('title_for_layout', $post['Post']['title'])?>
<article>
  <h2><?php echo $post['Post']['title']?></h2>
  <time>
    <?php echo $this->Time->format('n/j/y @ g:i a', $post['Post']['created'])?>
  </time>
  <?php echo $post['Post']['body']?>
  <!-- comments go here -->
</article>
