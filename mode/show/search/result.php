
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
  
//$sql = 'SELECT aid, atitle, acontent FROM article WHERE apublished = 1 AND (acontent LIKE "%'.$_POST['searchInput'].'%" OR aaddress LIKE "%.$_POST['searchInput'].%")'; 
$sql = "SELECT aname, atitle, acontent FROM article WHERE apublished = 1 AND acontent LIKE '%".$_POST['searchInput']."%'"; 
$req1 = SQLQuery($sql);

$sql = "SELECT aname, atitle, aaddress FROM article WHERE apublished = 1 AND aaddress LIKE '%".$_POST['searchInput']."%'"; 
$req2 = SQLQuery($sql);
?>

<div class="panel panel-default">
  <div class="panel-body">
    <?php echo mysql_num_rows($req1) + mysql_num_rows($req2); ?> réponse(s) trouvée(s)
  </div>
  <div class="panel-footer">
    <dl class="dl-horizontal">

      <?php while($data = mysql_fetch_assoc($req1)) { ?>
        <dt><?php echo $data['atitle']; ?></dt>
        <dd><?php echo substr( strip_tags($data['acontent']), 0, 365 ); ?>
          <a href="index.php?mode=show&category=article&action=view&name=<?php echo $data['aname']; ?>">Lire la suite...</a>
      	</dd>
        <br>
      <?php } ?>

      <?php while($data = mysql_fetch_assoc($req2)) { ?>
        <dt><?php echo $data['atitle']; ?></dt>
        <dd><?php echo substr( strip_tags($data['aaddress']), 0, 365 ); ?>
          <a href="index.php?mode=show&category=article&action=view&name=<?php echo $data['aname']; ?>">Lire la suite...</a>
      	</dd>
        <br>
      <?php } ?>

    </dl>
  </div>

</div>
