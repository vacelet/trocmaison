<?php
#-----------------------------------
#
# editerarticle.php : edit article 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 10/03/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 

# Get article according aid  
$sql = 'SELECT aid, apublished, acategory, asubcategory, atitle, acontent, aaddress, amap, atags FROM article WHERE aid = '.$_POST['aidInput'].' LIMIT 1'; 
$reqArticle = SQLQuery($sql);
$article = mysql_fetch_assoc($reqArticle);

# Get all tags
$sql = 'SELECT tid, tname FROM tag'; 
$reqTag = SQLQuery($sql);

# Get selected tags related to article
$SelectedTag = array();
$sql = 'SELECT tname FROM tag, tag_article WHERE ta_aid = '.$_POST['aidInput'].' AND ta_tid = tid'; 
$reqTagRelatedToArticle = SQLQuery($sql);
while($TagRelatedToArticle = mysql_fetch_assoc($reqTagRelatedToArticle)) {
    $SelectedTag[] = $TagRelatedToArticle["tname"];
}

?>

<div class="list-group">
	<a href="#" class="list-group-item active">
	  <h4>Edition de <?php echo $article["atitle"]; ?></h4>
	</a>
</div>
<br>
<form action="index.php?mode=admin&category=article&action=update" method="post">

  <!-- hidden aid -->
  <div class="form-group">
  	<input type = "hidden" value = "<?php echo $article["aid"]; ?>" name = "aidInput">
  </div>

  <!--  atitle -->
  <div class="form-group">
  	<label for="titreInput">Titre</label>
  	<input type="text" class="form-control" value="<?php echo $article["atitle"]; ?>" placeholder="<?php echo $article["atitle"]; ?>" name="titreInput">
  </div>

  <!--  published -->
  <div class="form-group">
  	<label for="publishedInput">Publié</label>
	    <select class="form-control" name="publishedInput">
	        <option selected="selected" value="<?php echo $article['apublished']?>"> <?php if ($article['apublished']) { echo "Publié";} else {echo "Non publié";} ?> </option>
	        <option value="1">Publié</option>
	        <option value="0">Non Publié</option>
	    </select>
  </div>

  <!--  Categorie -->
  <div class="form-group">
  	<label for="categoryInput">Categorie</label>
	    <select class="form-control" name="categoryInput">
	        <option selected="selected" value="<?php echo $article['acategory']?>"> <?php echo $article['acategory']; ?> </option>
	        <option value="sortie">Sortie</option>
	        <option value="restaurant">Restaurant</option>
	        <option value="maison">Maison</option>
	    </select>
  </div>

  <!--  SubCategorie -->
  <?php 
    if(!empty($article['asubcategory'])) {
      $subcategory = explode("-", $article['asubcategory']);
    } else {
      $subcategory = array("","");
    }
  ?>
  <div class="form-group">
  	<label for="subcategoryInput">Sub categorie</label>
		<select class="form-control" name="subcategoryInput">
			  <option selected="selected" value="<?php echo $article['asubcategory']?>"> <?php echo $subcategory[1]; ?> </option>
		    <option value="sortie-demi journee">Demi journée</option>
		    <option value="sortie-journee">Journée</option>
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
	    <?php echo $article['acontent']; ?>
	</textarea>
	<script>
    CKEDITOR.replace( 'contentInput', {height: '500px'} );
	</script>
  </div>

  <!--  addressInput -->
  <div class="form-group">
  	<label for="addressInput">Complément d'information</label>
	<textarea cols="80" name="addressInput" name="editor1" rows="5">
	        <?php echo $article['aaddress']; ?>
	</textarea>
	<script>
		CKEDITOR.replace( 'addressInput', {height: '200px'} );
	</script>
  </div>

  <!--  amapInput -->
  <div class="form-group">
  	<label for="amapInput">Coordonnees google map</label>
  	<input type="text" class="form-control" value="<?php echo $article["amap"]; ?>" name="amapInput">
  </div>

  <!-- tag -->
  <p><b>Tags</b></p>

  <?php while($tag = mysql_fetch_assoc($reqTag)) { ?>
    <div class="checkbox">
      <label><input type="checkbox" name="atagInput[]" value="<?php echo $tag["tname"]; ?>" <?php echo in_array($tag["tname"], $SelectedTag)?'checked=checked':""; ?> > <?php echo $tag["tname"]; ?> </label>
    </div>
  <?php } ?>

  <br>  
  <button type="submit" class="btn btn-success">Sauvegarder</button>

</form>
<br>
