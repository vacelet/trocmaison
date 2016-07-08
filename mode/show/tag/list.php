
<?php
#-----------------------------------
#
# list.php : list article related to one tag
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 18/03/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 
  

$sql = 'SELECT tid, tcomment FROM tag WHERE tname = "'.$_POST['tnameInput'].'"'; 
$req = SQLQuery($sql);
$datatag = mysql_fetch_assoc($req);

$sql = 'SELECT aname, atitle, acontent FROM article, tag_article WHERE apublished = 1 AND ta_aid = aid AND ta_tid = '.$datatag['tid']; 
$dataarticle = SQLQuery($sql);

?>

<div class="container">
  
  <div class="list-group">
    <a href="#" class="list-group-item active">
      <h4><?php echo $datatag['tcomment']; ?></h4>
    </a>

    <?php while($data = mysql_fetch_assoc($dataarticle)) { ?>
      <a href="index.php?mode=show&category=article&action=view&name=<?php echo $data['aname']; ?>" class="list-group-item"><h5><?php echo $data['atitle']; ?></h5><?php echo substr( strip_tags($data['acontent']), 0, 365 ); ?>...</a>
    <?php } ?>
  
  </div>

</div>

