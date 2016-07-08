<?php
#-----------------------------------
#
# listearticle.php : Show all articles order by categorie 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 17/03/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");

$req = SQLQuery('SELECT aid, apublished, acategory, asubcategory, atitle, aupdate FROM article ORDER BY acategory');
while($row = mysql_fetch_assoc($req)){
    $SQLArticle[] = $row;
}

?>

<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4>Liste des articles</h4>
  </a>
</div>
<br>
<form action="index.php?mode=admin&category=article&action=new" method="post"><button type="submit" class="btn btn-success">Nouvel article</button></form>
<br>
<br>
<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav active"><a href="#published" data-toggle="tab">Non publié</a></li>
        <li class="nav"><a href="#no_published" data-toggle="tab">Publié</a></li>
        <li class="nav"><a href="#restaurant" data-toggle="tab">Restaurant</a></li>
        <li class="nav"><a href="#sortie" data-toggle="tab">Sortie</a></li>
        <li class="nav"><a href="#maison" data-toggle="tab">Maison</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="published"><?php populateTab($SQLArticle, 'apublished', 0); ?></div>
        <div class="tab-pane fade" id="no_published"><?php populateTab($SQLArticle, 'apublished', 1); ?></div>
        <div class="tab-pane fade" id="restaurant"><?php populateTab($SQLArticle, 'acategory', 'restaurant'); ?></div>
        <div class="tab-pane fade" id="sortie"><?php populateTab($SQLArticle, 'acategory', 'sortie'); ?></div>
        <div class="tab-pane fade" id="maison"><?php populateTab($SQLArticle, 'acategory', 'maison'); ?></div>
    </div>
</div>


<?php function populateTab($SQLArticle, $criteriaToBeCheck, $criteriaValue) { ?>
  <?php #$len = count($SQLArticle);?>
  <?php #$criteriaToBeCheck = 'apublished'; /* Which tab will be display related to SQL value */ ?>
  <?php #$criteriaValue = $publish; /* Which value will be display in tab name */ ?>
  <table class="table  table-condensed table-hover">
  <thead>
    <tr>
      <th>Categorie</th>
      <th>Publié</th>
      <th>Titre</th>
      <th>Mise a jour</th>
      <th>Editer</th>
      <th>Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($SQLArticle as $data) { ?>
      <?php if ($data[$criteriaToBeCheck] == $criteriaValue) { ?>
        <tr>
          <td><?php echo $data['acategory']; ?></td>
          <td><?php echo $data['asubcategory']; ?></td>
          <td><?php echo $data['atitle']; ?></td>
          <td><?php echo $data['aupdate']; ?></td>
          <td>
              <form action="index.php?mode=admin&category=article&action=edit" method="post">
                <input type = "hidden" value = "<?php echo $data["aid"]; ?>" name = "aidInput">
                <button type="submit" class="btn btn-sm btn-success">Editer</button>
              </form>
          </td>
          <td>
              <form action="index.php?mode=admin&category=article&action=delete" method="post" onsubmit="return confirm('Etes-vous sur de votre choix ?');">
                <input type = "hidden" value = "<?php echo $data["aid"]; ?>" name = "aidInput">
                <input type = "hidden" value = "<?php echo $data["atitle"]; ?>" name = "titleInput">
                <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
              </form>
          </td>
        </tr>
      <?php } ?>
    <?php } ?>
  </tbody>
</table>
<?php } ?>