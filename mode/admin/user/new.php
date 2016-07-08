<?php
#-----------------------------------
#
# new.php : new one user 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 19/03/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");

?> 

<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4>Nouvel utilisateur></h4>
  </a>
</div>
<br>
<form action="index.php?mode=admin&category=user&action=insert" method="post">
	
  <!--  loginInput -->
  <div class="form-group">
  	<label for="loginInput">Login </label>
  	<input type="text" class="form-control" value="" name="loginInput">
  </div>

  <!--  passwordInput -->
  <div class="form-group">
    <label for="passwordInput">Password </label>
    <input type="text" class="form-control" value="" name="passwordInput">
  </div>

  <!--  availableInput -->
  <div class="form-group">
  	<label for="availableInput">Actif - Désactivé</label>
		<select class="form-control" name="availableInput">
        <option selected="selected" value=""></option>
        <option value="1">Actif</option>
        <option value="0">Désactivé</option>
      </select>
  </div>

  <!--  levelInput -->
  <div class="form-group">
  	<label for="levelInput">Groupe</label>
		<select class="form-control" name="levelInput">
        <option selected="selected" value=""></option>
        <option value="admin">admin</option>
	    <option value="invité">invité</option>
      </select>
  </div>

  <!--  Comment -->
  <div class="form-group">
  	<label for="addressInput">Commentaire</label>
	<textarea cols="80" name="commentInput" name="editor1" rows="5">
	</textarea>
	<script> 
		CKEDITOR.replace( 'commentInput' ); 
	</script>
  </div>

	<button type="submit" class="btn btn-success">Sauvegarder</button>
</form>