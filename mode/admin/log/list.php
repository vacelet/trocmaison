<?php
#-----------------------------------
#
# listeLog.php : Show all log order by date 
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 17/03/2015
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php");

$req = SQLQuery('SELECT lid, lmessage, laccount, lalert, ldate FROM log ORDER BY ldate DESC');

?>

<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4>Logs systemes</h4>
  </a>
</div>
<br>
<form action="index.php?mode=admin&category=log&action=delete" method="post">
  <input type = "hidden" value = "" name = "lidInput">
  <button type="submit" class="btn btn-danger">Suppression de toutes les logs</button>
</form>
<br>
<br>

<div class="container">
  <table class="table  table-condensed table-hover">
    <thead>
      <tr>
        <th>Message</th>
        <th>Compte</th>
        <th>Date (UTC)</th>
        <th>Suppression</tg>
      </tr>
    </thead>
    <tbody>
    <?php
      while($row = mysql_fetch_assoc($req)){
        echo '<tr class="alert alert-'.$row['lalert'].'">';
          echo '<td>'.$row['lmessage'].'</td>';
          echo '<td>'.$row['laccount'].'</td>';
          echo '<td>'.$row['ldate'].'</td>';
          echo '<td>';
            echo '<form action="index.php?mode=admin&category=log&action=delete" method="post">';
              echo '<button type="submit" class="btn btn-sm btn-danger">Suppression</button>';
              echo '<input type = "hidden" value = "'.$row['lid'].'" name = "lidInput">';
            echo '</form>';
          echo '<td>';
        echo '</tr>';
      }
    ?>
    </tbody>
  </table>
</div>
