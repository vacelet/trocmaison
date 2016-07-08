<?php 
#-----------------------------------
#
# sortie_menu.php : manage sortie menu
# Author : Nicolas Vacelet
# Last update : 16/02/2015
#
#-----------------------------------

?>
<div class="btn-group">
  <button type="button" class="btn btn-default navbar-btn dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-share"></span> Sorties <span class="caret"></span></button>
  <ul class="dropdown-menu" role="menu">
    <?php
      $req = SQLQuery('SELECT aname, atitle FROM article WHERE apublished = 1 AND acategory = "sortie" AND asubcategory = "sortie-demi journee" ORDER BY atitle'); 
      if ( mysql_num_rows($req) > 0 ) {
        echo '<li> <center><span class="text-muted"> Demi journée</span></center></li>';
        echo '<li class="divider"></li>';
        while($data = mysql_fetch_assoc($req)) {
          echo '<li>';
            echo '<a href="index.php?mode=show&category=article&action=view&name='.$data['aname'].'">'.$data['atitle'].'</a>';
            echo '</li>';
        }
      }
    ?>

    <?php
      $req = SQLQuery('SELECT aname, atitle FROM article WHERE apublished = 1 AND acategory = "sortie" AND asubcategory = "sortie-journee" ORDER BY atitle'); 
      if ( mysql_num_rows($req) > 0 ) {
        echo '<li class="divider"></li>';
        echo '<li> <center><span class="text-muted"> Journée</span></center></li>';
        echo '<li class="divider"></li>';
        while($data = mysql_fetch_assoc($req)) {
          echo '<li>';
            echo '<a href="index.php?mode=show&category=article&action=view&name='.$data['aname'].'">'.$data['atitle'].'</a>';
            echo '</li>';
        }
      }
    ?>

    <?php
      $req = SQLQuery('SELECT aname, atitle FROM article WHERE apublished = 1 AND acategory = "sortie" AND asubcategory = "sortie-parc" ORDER BY atitle'); 
      if ( mysql_num_rows($req) > 0 ) {
        echo '<li class="divider"></li>';
        echo '<li> <center></span><span class="text-muted"> Parc</span></center></li>';
        echo '<li class="divider"></li>';
        while($data = mysql_fetch_assoc($req)) {
          echo '<li>';
            echo '<a href="index.php?mode=show&category=article&action=view&name='.$data['aname'].'">'.$data['atitle'].'</a>';
            echo '</li>';
        }
      }
    ?>

  </ul>
</div>

