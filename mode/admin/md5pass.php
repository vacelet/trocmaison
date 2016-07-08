<?php
#-----------------------------------
#
# listeruser.php : edit one user 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 02/02/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");



if ( empty($_POST['passwordInput']) ) {
	echo '<form action="md5pass.php" method="post">
		<div class="row">
		  <div calss="elven colums">
		    <label for="loginInput">Password</label><input class="u-full-width" type="text" value="password" name="passwordInput">
		  </div>
		</div>
		<input class="button-primary" type="submit" value="generate">
	</form>';
} else {
	echo md5($_POST['passwordInput']);
}