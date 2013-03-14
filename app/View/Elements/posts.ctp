<?php foreach ($posts as $post):?>
<article class="well">
  <h2><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', "{$post['Post']['id']}-{$post['Post']['slug']}"))?></h2>
  <time title="<?php echo $this->Time->format('n/j/y @ g:i a', $post['Post']['created'])?>">
    <?php echo $this->Time->timeAgoInWords($post['Post']['created'])?>
  </time>
  <?php echo (!empty($post['Post']['body'])) ? $post['Post']['body'] : '';?>
  <footer>
    <?php
    echo $this->Html->link('View post', array('controller' => 'posts', 'action' => 'view', "{$post['Post']['id']}-{$post['Post']['slug']}"), array('title' => $post['Post']['title'], 'rel' => 'permalink'));
    if (!empty($user)) {
      echo '&nbsp;|&nbsp;' . $this->Html->link('Edit post', array('admin' => true, 'controller' => 'posts', 'action' => 'edit', $post['Post']['id'])) . '&nbsp;|&nbsp;' . $this->Html->link('Delete post', array('admin' => true, 'controller' => 'posts', 'action' => 'delete', $post['Post']['id']));
    }
    ?>
  </footer>
</article>
<?php endforeach;?>
