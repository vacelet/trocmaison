<?php
#-----------------------------------
#
# admin.php : route admin page
# Author : Nicolas Vacelet
# Last update : 24/01/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 

switch ( $_GET['category'] ) {

    case 'article':
        switch ( $_GET['action'] ) {
            case "new": case "edit": case "list":
                include(DOCUMENTROOT.'/admin/'.$_GET['action'].'.php');
                break;

            case "save":
                SaveArticle();
                break;

        }
    break;

    case 'user':
        switch ( $_GET['action'] ) {
            case "list":
                include(DOCUMENTROOT.'/admin/'.$_GET['action'].'.php');
                break;

            case "save":
                SaveUser();
                break;
        }
    break;

    default:
        include('default.php');
    }
}

?>