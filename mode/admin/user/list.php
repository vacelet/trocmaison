<?php
#-----------------------------------
#
# listeruser.php : Show all user 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 02/02/2015
#
#-----------------------------------

  require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");

  $req = SQLQuery('SELECT lid, llogin, llevel, lavailable, lcomment FROM login ORDER BY llevel');
?> 

<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4>Liste des utilisateurs</h4>
  </a>
</div>
<br>
<form action="index.php?mode=admin&category=user&action=new" method="post"><button type="submit" class="btn btn-success">Nouvel utilisateur</button></form>
<br>
<table class="table  table-condensed table-hover">
  <thead>
    <tr>
      <th>Login</th>
      <th>Type</th>
      <th>Status</th>
      <th>Comment</th>
      <th>Editer</th>
      <th>Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php while($data = mysql_fetch_assoc($req)) { ?>
      <tr>
      	<td><?php echo $data['llogin'] ?></td>
      	<td><?php echo $data['llevel'] ?></td>
      	<td><?php if ($data['lavailable']) { echo "Actif";} else {echo "Désactivé";} ?></td>
        <td><?php echo $data['lcomment'] ?></td>
      	<td>
            <form action="index.php?mode=admin&category=user&action=edit" method="post">
              <input type = "hidden" value = "<?php echo $data["lid"] ?>" name = "lidInput">
      		  <button type="submit" class="btn btn-success">Editer</button>
      	    </form>
      	</td>
        <td>
            <form action="index.php?mode=admin&category=user&action=delete" method="post" onsubmit="return confirm('Etes-vous sur de votre choix ?');">
              <input type = "hidden" value = "<?php echo $data["lid"] ?>" name = "lidInput">
              <input type = "hidden" value = "<?php echo $data["llogin"] ?>" name = "loginInput">
            <button type="submit" class="btn btn-danger launchConfirm">Supprimer</button>
            </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
