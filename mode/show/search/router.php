<?php
#-----------------------------------
#
# router.php : route according index param : mode / category / action 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 16/02/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");


if (isset($_GET['action'])) {
		
		switch ( $_GET['action'] ) {
			case "result":
				include(DOCUMENTROOT.'/mode/show/search/'.$_GET['action'].'.php');
				break;

			default:
				include(DOCUMENTROOT.'/htmlpage/welcome.php');
		}

} else {
  		
  		include(DOCUMENTROOT.'/htmlpage/welcome.php');
}

?>