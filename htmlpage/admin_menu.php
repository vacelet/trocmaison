<?php 
#-----------------------------------
#
# admin_menu.php : manage administration menu
# Author : Nicolas Vacelet
# Last update : 02/02/2015
#
#-----------------------------------

if (isset($_SESSION['user']['type']) ) {
  if( $_SESSION['user']['type'] == 'admin') { 
      echo '<div class="btn-group">';
        echo '<button type="button" class="btn btn-default navbar-btn dropdown-toggle" data-toggle="dropdown">';
          echo '<span class="glyphicon glyphicon-wrench"></span> Admin <span class="caret"></span>';
        echo '</button>';
        echo '<ul class="dropdown-menu" role="menu">';
          echo '<li><a href="index.php?mode=admin&category=article&action=list">Arcticle</a></li>';
          echo '<li><a href="index.php?mode=admin&category=tag&action=list">Tag</a></li>';
          echo '<li><a href="index.php?mode=admin&category=user&action=list">Login</a></li>';
          echo '<li><a href="index.php?mode=admin&category=log&action=list">Log</a></li>';
        echo '</ul>';
      echo '</div>';
  }
}

?>  