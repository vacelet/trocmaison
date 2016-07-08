<?php
#-----------------------------------
#
# edit.php : edit one user 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 16/02/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");

$req = SQLQuery('SELECT lid, llogin, llevel, lavailable, lcomment FROM login WHERE lid = '.$_POST['lidInput'].' LIMIT 1'); 
$data = mysql_fetch_assoc($req);
?> 

<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4>Edition du compte de <?php echo $data["llogin"]?></h4>
  </a>
</div>
<br>
<form action="index.php?mode=admin&category=user&action=update" method="post">
	
	<!-- hidden lid -->
  <div class="form-group">
  	<input type = "hidden" value = "<?php echo $data["lid"] ?>" name = "lidInput">
  </div>

  <!--  loginInput -->
  <div class="form-group">
  	<label for="amapInput">Login </label>
  	<input type="text" class="form-control" value="<?php echo $data["llogin"]?>" name="loginInput">
  </div>

  <!--  availableInput -->
  <div class="form-group">
  	<label for="availableInput">Actif - Désactivé</label>
		<select class="form-control" name="availableInput">
        <option selected="selected" value="<?php echo $data['lavailable']?>"> <?php if ($data['lavailable']) { echo "Actif";} else {echo "Désactivé";} ?> </option>
        <option value="1">Actif</option>
        <option value="0">Désactivé</option>
      </select>
  </div>

  <!--  levelInput -->
  <div class="form-group">
  	<label for="levelInput">Groupe</label>
		<select class="form-control" name="levelInput">
        <option selected="selected" value="<?php echo $data['llevel'] ?>"><?php echo $data['llevel'] ?></option>
        <option value="admin">admin</option>
	    <option value="invité">invité</option>
      </select>
  </div>

  <!--  Comment -->
  <div class="form-group">
  	<label for="addressInput">Commentaire</label>
	<textarea cols="80" name="commentInput" name="editor1" rows="5">
	        <?php echo $data['lcomment']?>
	</textarea>
	<script> 
		CKEDITOR.replace( 'commentInput' ); 
	</script>
  </div>

	<button type="submit" class="btn btn-success">Sauvegarder</button>
</form>