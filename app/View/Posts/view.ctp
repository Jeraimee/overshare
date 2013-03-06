<?php $this->set('title_for_layout', $post['Post']['title'])?>
<?php if (!empty($user)):?>
<ul class="pull-right well nav nav-list">
  <li class="nav-header">Administration</li>
  <li>
    <?php echo $this->Html->link('Edit post', array('admin' => true, 'action' => 'edit', $post['Post']['id']))?>
    <?php echo $this->Html->link('Delete post', array('admin' => true, 'action' => 'delete', $post['Post']['id']), null, "Are you sure you want to delete this post?")?>
  </li>
</ul>
<?php endif;?>
<article>
  <h2><?php echo $post['Post']['title']?></h2>
  <time>
    <?php echo $this->Time->format('n/j/y @ g:i a', $post['Post']['created'])?>
  </time>
  <?php echo $post['Post']['body']?>
  <!-- comments go here -->
</article>
