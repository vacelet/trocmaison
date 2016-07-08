<?php 
#-----------------------------------
#
# menu.php : print dynamic menu
# Author : Nicolas Vacelet
# Last update : 16/02/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");

?>
        <?php //echo "<li class="no-sub"><a class="top-heading" href="/">Home</a></li>"; ?>
        <?php //include(DOCUMENTROOT."/frontpage/sortie_menu.php"); ?>
        <?php //include(DOCUMENTROOT."/frontpage/con_decon_menu.php"); ?>
        <?php //include(DOCUMENTROOT."/frontpage/admin_menu.php"); ?>




<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="glyphicon glyphicon-align-justify"></span>
      </button>
    </div><!-- /.navbar-header -->
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar-collapse collapse" role="navigation">
	  <?php include(DOCUMENTROOT."/htmlpage/home_menu.php"); ?>
      <?php include(DOCUMENTROOT."/htmlpage/resto_menu.php"); ?>
      <?php include(DOCUMENTROOT."/htmlpage/sortie_menu.php"); ?>
      <?php include(DOCUMENTROOT."/htmlpage/house_menu.php"); ?>
      <?php include(DOCUMENTROOT."/htmlpage/con_decon_menu.php"); ?>
      <?php include(DOCUMENTROOT."/htmlpage/admin_menu.php"); ?>
      <?php include(DOCUMENTROOT."/htmlpage/search_menu.php"); ?>

    </div><!-- /.navbar-collapse -->


  </div><!-- /.container-fluid -->
</nav>
