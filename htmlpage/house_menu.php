<?php 
#-----------------------------------
#
# house_menu.php : manage house menu
# Author : Nicolas Vacelet
# Last update : 16/02/2015
#
#-----------------------------------

?>

<?php if (isset($_SESSION['user']['type']) ) { ?>
  <div class="btn-group">
    <button type="button" class="btn btn-default navbar-btn dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-home"></span> Maison <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <?php
        $req = SQLQuery('SELECT aname, atitle FROM article WHERE apublished = 1 AND acategory = "maison" ORDER BY atitle'); 
        if ( mysql_num_rows($req) > 0 ) {

          while($data = mysql_fetch_assoc($req)) {
            echo '<li>';
              echo '<a href="index.php?mode=show&category=article&action=view&name='.$data['aname'].'">'.$data['atitle'].'</a>';
              echo '</li>';
          }
        }
      ?>

    </ul>
  </div>
<?php } ?>