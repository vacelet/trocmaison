<?php
#-----------------------------------
#
# router.php : route according index param : mode / category / action 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 04/02/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");


if (isset($_GET['mode'])) {
		
		switch ( $_GET['mode'] ) {
			
			case "show": 
				include(DOCUMENTROOT.'/mode/'.$_GET['mode'].'/router.php');
				break;

			case "connection": case "deconnection":
				include(DOCUMENTROOT.'/mode/'.$_GET['mode'].'/router.php');
				break;

			case "admin":
				include(DOCUMENTROOT.'/mode/'.$_GET['mode'].'/router.php');
				break;

			case "test":
				include(DOCUMENTROOT.'/mode/test.php');
				break;

			default:
				include(DOCUMENTROOT.'/htmlpage/welcome.php');
		}

} else {
  		
  		include(DOCUMENTROOT.'/htmlpage/welcome.php');
}

?>