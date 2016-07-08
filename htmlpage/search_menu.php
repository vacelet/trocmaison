<?php 
#-----------------------------------
#
# search_menu.php : manage search menu
# Author : Nicolas Vacelet
# Last update : 16/02/2015
#
#-----------------------------------

?>

<form class="navbar-form navbar-right" role="search" action="index.php?mode=show&category=search&action=result" method="post">
	<div class="form-group">
		<input type="text" class="form-control" placeholder="Search" name="searchInput">
	</div>
	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"</span></button>
</form>