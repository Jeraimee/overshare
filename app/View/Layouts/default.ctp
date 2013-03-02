<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title_for_layout;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <?php echo $this->Html->script(array('jquery-1.9.1.min', 'bootstrap.min', 'cakebootstrap'));
    echo $this->Html->css(array('bootstrap.min', 'bootstrap-responsive.min', 'overshare'))?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo $this->base?>/js/html5shiv.js"></script>
    <![endif]-->

    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 3em 0;
      }
    </style>

  </head>

  <body>

    <div class="container">

      <div class="masthead">

        <h1><?php echo $this->Html->link('asdf', '/', array('title' => 'asdf', 'rel' => 'home', 'class' => 'brand'))?></h1>
        <?php echo $this->element('navbar')?>
      </div>

      <div class="row-fluid">
  			<?php echo $this->Session->flash();
  			echo $this->fetch('content')?>
      </div>

      <hr>

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div> <!-- /container -->

  </body>
</html>
