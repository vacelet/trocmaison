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
				include(DOCUMENTROOT.'/mode/admin/article/'.$_GET['action'].'.php');
				break;

			case "update":
                updateArticle();
                break;

            case "insert":
                insertArticle();
                break;

			case "delete":
                deleteArticle();
                break;

			default:
				include(DOCUMENTROOT.'/htmlpage/welcome.php');

		}

} else {
  		
  		include(DOCUMENTROOT.'/htmlpage/welcome.php');
}

?>