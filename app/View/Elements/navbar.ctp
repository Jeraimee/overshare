<div class="navbar">
  <div class="navbar-inner">
    <div class="container">

      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="nav-collapse collapse">
        <ul class="nav">
          <?php foreach ($pages as $_slug => $_title):?>
          <li><?php echo $this->Html->link($_title, "/pages/{$_slug}", array('title' => $_title, 'rel' => 'permalink'))?></li>
          <li class="divider-vertical"></li>
          <?php endforeach;?>
          <!-- li class="dropdown">
            <a href="#" data-toggle="dropdown">Pages <b class="caret"></b></a>
            <ul class="dropdown-menu">
            </ul>
          </li -->
        </ul>

        <ul class="nav pull-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              More <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li>
                <?php echo $this->Html->link('New Post', array('controller' => 'posts', 'action' => 'add', 'admin' => true))?>
              </li>
              <li>
                <?php echo $this->Html->link('New Page', array('controller' => 'pages', 'action' => 'add', 'admin' => true))?>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </div>
  </div>
</div><!-- /.navbar -->
