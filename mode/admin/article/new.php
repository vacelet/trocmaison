<?php
#-----------------------------------
#
# newarticle.php : new article 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 10/03/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 

# Get all tags
$sql = 'SELECT tid, tname FROM tag'; 
$reqTag = SQLQuery($sql);

?>

<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4>Nouvel article</h4>
  </a>
</div>
<br>
<form action="index.php?mode=admin&category=article&action=insert" method="post">

  <!--  anameInput -->
  <div class="form-group">
  	<label for="anameInput">Référence de l'article en database</label>
  	<input class="form-control" type="text" value="" name="anameInput">
  </div>

  <!--  titreInput -->
  <div class="form-group">
  	<label for="titreInput">Titre</label>
  	<input type="text" class="form-control" value="" placeholder="" name="titleInput">
  </div>

  <!--  publishedInput -->
  <div class="form-group">
  	<label for="publishedInput">Publié</label>
	    <select class="form-control" name="publishedInput">
	        <option selected="selected" value=""></option>
	        <option value="1">Publié</option>
	        <option value="0">Non Publié</option>
	    </select>
  </div>

  <!--  categoryInput -->
  <div class="form-group">
  	<label for="categoryInput">Categorie</label>
	    <select class="form-control" name="categoryInput">
	        <option selected="selected" value=""></option>
	        <option value="sortie">Sortie</option>
	        <option value="restaurant">Restaurant</option>
	        <option value="maison">Maison</option>
	    </select>
  </div>

  <!--  subcategoryInput -->
  <div class="form-group">
  	<label for="subcategoryInput">Sub categorie</label>
		<select class="form-control" name="subcategoryInput">
		    <option selected="selected" value=""></option>
        <option value="sortie-demi journée">Demi journée</option>
        <option value="sortie-journée">Journée</option>
        <option value="sortie-parc">Parc</option>
        <option value="restaurant-familliale">Familliale</option>
        <option value="restaurant-plaisir">Plaisir</option>
        <option value="restaurant-gastronomique">Gastronomique</option>
		</select>
  </div>

  <!--  contentInput -->
  <div class="form-group">
  	<label for="contentInput">Contenu de l'article</label>
	<textarea cols="80" name="contentInput" name="editor1" rows="10">
	</textarea>
	<script>
	    var roxyFileman = '/fileman/index.html'; 
		CKEDITOR.replace( 'contentInput' ); 
	</script>
  </div>

  <!--  addressInput -->
  <div class="form-group">
  	<label for="addressInput">Complément d'information</label>
	<textarea cols="80" name="addressInput" name="editor1" rows="5">
	</textarea>
	<script>
	    var roxyFileman = '/fileman/index.html'; 
		CKEDITOR.replace( 'addressInput' ); 
	</script>
  </div>

  <!--  amapInput -->
  <div class="form-group">
  	<label for="amapInput">Coordonnees google map</label>
  	<input type="text" class="form-control" value="" name="amapInput">
  </div>

  <!-- tag -->
  <p><b>Tags</b></p>

  <?php while($tag = mysql_fetch_assoc($reqTag)) { ?>
    <div class="checkbox">
      <label><input type="checkbox" name="atagInput[]" value="<?php echo $tag["tname"]; ?>" > <?php echo $tag["tname"]; ?> </label>
    </div>
  <?php } ?>
		
	<button type="submit" class="btn btn-success">Sauvegarder</button>
</form>
<br>