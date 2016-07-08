<?php 
#-----------------------------------
#
# con_decon_menu.php : manage connexion and deconnexion menu
# Author : Nicolas Vacelet
# Last update : 12/02/2015
#
#-----------------------------------

if( empty($_SESSION['user']) ) {
  echo '<a href="index.php?mode=connection&category=connection" class="btn btn-default navbar-btn" role="button"><span class="glyphicon glyphicon-link"></span> Connection</a>';
  } else {
  echo '<a href="index.php?mode=connection&category=deconnection" class="btn btn-default navbar-btn" role="button"><span class="glyphicon glyphicon-link"></span> Deconnection</a>';
}