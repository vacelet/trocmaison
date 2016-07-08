<?php
#-----------------------------------
#
# article.php : Show one article related to $_GET['name']
# Author : Nicolas Vacelet
# Last update : 02/06/2016
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 

$name = $_GET['name'];
$reqArticle = SQLQuery('SELECT aid, atitle, acontent, aaddress, amap, atags, aupdate FROM article WHERE aname = "'.$name.'"');

date_default_timezone_set('Europe/Paris')

?> 

<?php while($data = mysql_fetch_assoc($reqArticle)) { ?>
  <?php InitGoogleMap($data['amap']); ?>

  <div class="list-group">
    <a href="#" class="list-group-item active">
      <h4><?php echo $data['atitle'] ?></h4>
    </a>
  </div>

    <div class="row">

      <!-- first colum -->
      <div class="col-md-5 col-sm-12">
            <?php echo '<hr>'.$data['acontent'].'<hr>'; ?>
            <br>
			<?php include($_SERVER['DOCUMENT_ROOT']."/mode/show/article/comment.php"); ?>
      </div>

      <!-- second colum -->
      <div class="col-md-5  col-md-offset-2 col-sm-12">
          <?php if ($data['amap']) { ?>
              <center><div id="googleMap" style="width:450px;height:400px;"></div></center>
            </p>
          <?php }; ?>
          <?php echo '<hr>'.$data['aaddress'].'<hr>'; ?>
          <?php echo '<h5>'.printTags($data['aid']).'</h5>'; ?>
      </div>

    </div>


<?php }; ?>
