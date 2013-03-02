<?php foreach ($posts as $post):?>
<article class="well">
  <h2><?php echo $post['Post']['title']?></h2>
  <time title="<?php echo $this->Time->format('n/j/y @ g:i a', $post['Post']['created'])?>">
    <?php echo $this->Time->timeAgoInWords($post['Post']['created'])?>
  </time>

  <?php echo $post['Post']['body']?>

  <footer>
    <?php echo $this->Html->link('View Post', array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), array('title' => $post['Post']['title'], 'rel' => 'permalink'))?>
  </footer>
</article>
<?php endforeach;?>