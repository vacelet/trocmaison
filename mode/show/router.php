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


if (isset($_GET['category'])) {
		
		switch ( $_GET['category'] ) {
			case "article":
				include(DOCUMENTROOT.'/mode/show/'.$_GET['category'].'/router.php');
				break;

			case "search":
				include(DOCUMENTROOT.'/mode/show/'.$_GET['category'].'/router.php');
				break;

			case "tag":
				include(DOCUMENTROOT.'/mode/show/'.$_GET['category'].'/router.php');
				break;

			default:
				include(DOCUMENTROOT.'/htmlpage/welcome.php');
		}

} else {
  		
  		include(DOCUMENTROOT.'/htmlpage/welcome.php');
}

?>
