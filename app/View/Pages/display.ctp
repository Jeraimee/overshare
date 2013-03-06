<?php $this->set('title_for_layout', $page['Page']['title'])?>
<?php if (!empty($user)):?>
<ul class="pull-right well nav nav-list">
  <li class="nav-header">Administration</li>
  <li>
    <?php echo $this->Html->link('Edit page', array('admin' => true, 'action' => 'edit', $page['Page']['id']))?>
    <?php echo $this->Html->link('Delete page', array('admin' => true, 'action' => 'delete', $page['Page']['id']), null, "Are you sure you want to delete this page?")?>
  </li>
</ul>
<?php endif;?>
<article>
  <h2><?php echo $page['Page']['title']?></h2>
  <?php echo $page['Page']['body']?>
</article>
