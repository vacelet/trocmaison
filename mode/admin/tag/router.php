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


if (isset($_GET['action'])) {
		
		switch ( $_GET['action'] ) {

			case "list": case "edit": case "new":
				include(DOCUMENTROOT.'/mode/admin/tag/'.$_GET['action'].'.php');
				break;

			case "update":
                updateTag();
                break;

            case "insert":
                insertTag();
                break;

			case "delete":
                deleteTag();
                break;

			default:
				include(DOCUMENTROOT.'/htmlpage/welcome.php');

		}

} else {
  		
  		include(DOCUMENTROOT.'/htmlpage/welcome.php');
}

?>