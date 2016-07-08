<?php
#-----------------------------------
#
# listTag.php : Show all tags order by categorie 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 20/02/2015
#
#-----------------------------------

  require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");

  $req = SQLQuery('SELECT tid, tname, tcomment, tupdate FROM tag ORDER BY tname');
?> 

<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4>Liste des tags</h4>
  </a>
</div>
<br>
<form action="index.php?mode=admin&category=tag&action=new" method="post"><button type="submit" class="btn btn-success">Nouveau tag</button></form>
<br>
<table class="table  table-condensed table-hover">
  <thead>
    <tr>
      <th>name</th>
      <th>commentaire</th>
      <th>Mise a jour</th>
      <th>Editer</th>
      <th>Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php while($data = mysql_fetch_assoc($req)) { ?>
      <tr>
      	<td><?php echo $data['tname'] ?></td>
        <td><?php echo $data['tcomment'] ?></td>
      	<td><?php echo $data['tupdate'] ?></td>
      	<td>
            <form action="index.php?mode=admin&category=tag&action=edit" method="post">
              <input type = "hidden" value = "<?php echo $data["tid"] ?>" name = "tidInput">
      		  <button type="submit" class="btn btn-success">Editer</button>
      	    </form>
      	</td>
        <td>
            <form action="index.php?mode=admin&category=tag&action=delete" method="post" onsubmit="return confirm('Etes-vous sur de votre choix ?');">
              <input type = "hidden" value = "<?php echo $data["tid"] ?>" name = "tidInput">
              <input type = "hidden" value = "<?php echo $data["tname"] ?>" name = "tnameInput">
            <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
