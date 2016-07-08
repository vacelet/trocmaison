<?php
#-----------------------------------
#
# newtag.php : new tag
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 20/02/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 

?>

<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4>Nouveau tag</h4>
  </a>
</div>
<br>
<form action="index.php?mode=admin&category=tag&action=insert" method="post">

  <!--  tname -->
  <div class="form-group">
  	<label for="tnameInput">Nom du tag</label>
  	<input type="text" class="form-control" value="" placeholder="" name="tnameInput">
  </div>

  <!--  tcommnet -->
  <div class="form-group">
  	<label for="tcommentInput">Commentaire du tag</label>
	<textarea cols="80" name="tcommentInput" name="editor1" rows="10">
	</textarea>
	<script>
		CKEDITOR.replace( 'tcommentInput' ); 
	</script>
  </div>
		
	<button type="submit" class="btn btn-success">Sauvegarder</button>
</form>