<html lang="en">
  <head>
    
		<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
    <title>AkiraSoft[Servicios]</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

		<?php
      echo $this->Html->meta('favicon.ico', 'img/favicon.ico', array('type' => 'icon'));
      echo $this->Html->css(array('bootstrap', 'bootstrap-responsive', 'datetimepicker', 'akira', 'akira.btns'));
		  echo $this->Html->script(array('jquery', 'bootstrap', 'mousetrap', 'navbar'));
      echo $this->Html->charset('UTF-8'); 
    ?>

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
  </head>

  <body>

    <nav id='nbft' class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">

          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div id='Empresa'>
            <?php echo $this->Html->link($this->Session->read('institucion'), '/', array("class" => array("brand", "visible-lg-block")));?>  </div>   

            <div class="nav-collapse collapse">
              <p class="navbar-text pull-right">
  						<?php
                if($auth->login()) { 
                  echo 'Conectado como ' . $this->Html->link($auth->user('username'), array('controller' => 'users', 'action' => 'passwd'), array('escape' => false, 'class' => 'navbar-link')) . ' | ' . $this->Html->link(' [Salir] ', array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'class' => 'navbar-link'));
                }else { 
                  echo $this->Html->link('<i class="icon-user icon-white"></i>  Ingresar', array('controller' => 'users', 'action' => 'login'), array('escape' => false, 'class' => 'navbar-link'));
                } ?>
              </p>
            </div><!--/.nav-collapse -->
        </div>
      </div>
    </nav>
    <div class="container-fluid warning">
      <div class="row-fluid">
        <div id='menuB' class="span2 ">
          <div class="sidebar-nav">
            <ul class="nav nav-list">
              <!-- verificamos que el usuario este logeado para mostrar el menú -->
  						<?php 
                if($auth->login()) {
                  echo $leMenu;
                } 
                 if(!$auth->login()) { echo '<h4>Si desea obtener una cuenta contacte con el Administrador.</h4>'; } ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="span9">
        	<?php echo $this->Session->flash('auth'); ?>
        	<?php echo $this->Session->flash(); ?>
	    	  <?php echo $this->fetch('content'); ?>
          <?php 
            if(isset($keymap)){
              echo $keymap;
            }
          ?>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
			<p class='left'>&copy; AkiraSoft 2016 </p><p class='right'> </p>
      </footer>

    </div>
  </body>
</html>
