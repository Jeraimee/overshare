<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title_for_layout;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <?php echo $this->Html->script(array('jquery-1.9.1.min', 'bootstrap.min', 'cakebootstrap'));
    echo $this->Html->css(array('bootstrap.min', 'bootstrap-responsive.min'))?>

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

        <h1>asdf</h1>

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
                  <li><a href="#">Something</a></li>
                  <li class="divider-vertical"></li>
                  <li><a href="#">Something else</a></li>
                  <li class="divider-vertical"></li>
                  <li class="dropdown">
                    <a href="#" data-toggle="dropdown">Another thing <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    </ul>
                </ul>

                <ul class="nav pull-right">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      More <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </div><!-- /.navbar -->
      </div>

      <div class="row-fluid">
  			<?php echo $this->Session->flash();
  			echo $this->fetch('content');?>
      </div>

      <hr>

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div> <!-- /container -->

  </body>
</html>
