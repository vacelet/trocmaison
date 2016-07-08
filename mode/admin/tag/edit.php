<?php
#-----------------------------------
#
# editerarticle.php : edit article 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 16/02/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 
  
$sql = 'SELECT tid, tname, tcomment FROM tag WHERE tid = '.$_POST['tidInput'].' LIMIT 1'; 
$req = SQLQuery($sql);
$data = mysql_fetch_assoc($req);

?>

<div class="list-group">
	<a href="#" class="list-group-item active">
	  <h4>Edition de <?php echo $data["tname"]?></h4>
	</a>
</div>
<br>
<form action="index.php?mode=admin&category=tag&action=update" method="post">

  <!-- hidden tid -->
  <div class="form-group">
  	<input type = "hidden" value = "<?php echo $data["tid"] ?>" name = "tidInput">
  </div>

  <!--  tname -->
  <div class="form-group">
  	<label for="tnameInput">Nom du tag</label>
  	<input type="text" class="form-control" value="<?php echo $data["tname"]?>" placeholder="<?php echo $data["tname"]?>" name="tnameInput">
  </div>
  
  <!--  tcomment -->
  <div class="form-group">
  	<label for="tcommentInput">commentaire du tag</label>
	<textarea cols="80" name="tcommentInput" name="editor1" rows="10">
	    <?php echo $data['tcomment']?>
	</textarea>
	<script>
		CKEDITOR.replace( 'tcommentInput' ); 
	</script>
  </div>
		
	<button type="submit" class="btn btn-success">Sauvegarder</button>
</form>
<br>


