<?php
#-----------------------------------
#
# router.php : route according index param : mode / category / action 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 12/07/2016
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");


if (isset($_GET['action'])) {
		
		switch ( $_GET['action'] ) {
			case "view":
				include(DOCUMENTROOT.'/mode/show/article/'.$_GET['action'].'.php');
				break;
				
			case "insert":
				insertComment();
				break;

			case "update":
				updateComment();
				break;

			default:
				include(DOCUMENTROOT.'/htmlpage/welcome.php');
		}

} else {
  		
  		include(DOCUMENTROOT.'/htmlpage/welcome.php');
}

?>
