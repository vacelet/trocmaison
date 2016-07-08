<?php
#-----------------------------------
#
# router.php : route according index param : mode / category / action 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 17/02/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");


if (isset($_GET['action'])) {
		
		switch ( $_GET['action'] ) {

			case "list":
				include(DOCUMENTROOT.'/mode/admin/log/'.$_GET['action'].'.php');
				break;

			case "delete":
                deleteLog();
                break;

			default:
				include(DOCUMENTROOT.'/htmlpage/welcome.php');

		}

} else {
  		
  		include(DOCUMENTROOT.'/htmlpage/welcome.php');
}

?>