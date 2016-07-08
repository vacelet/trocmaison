<?php
#-----------------------------------
#
# comment.php : Show all comments related to article
# Author : Nicolas Vacelet
# Last update : 10/06/2016
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 
$reqComment = SQLQuery('SELECT ccomment,cstar,ccdate,cauthor FROM comment WHERE caid = '.$data['aid'].' AND cpublished = 1 ORDER BY cid');

#$reqComment = SQLQuery('SELECT ccomment,cstar,ccdate,cauthor FROM comment WHERE cpublished = 1 ORDER BY cid');
/*
echo '<div>Commentaires</div><br>';
while($dataComment = mysql_fetch_assoc($reqComment)) {
	#echo '<div class="alert alert-info" role="alert">Le '.date('d-m-Y H:i:s', strtotime($dataComment['ccdate'])).' de '.$dataComment['cauthor'].'</div>';
	#echo '<div><small>Le '.date('d-m-Y H:i:s', strtotime($dataComment['ccdate'])).' de '.$dataComment['cauthor'].'</small></div>'; 
	#echo $dataComment['ccomment'].'<br><br>';
	echo '<div class="panel panel-info">';
		echo '<div class="panel-heading">';
			echo '<h6 class="panel-title"><small>Le '.date('d-m-Y H:i:s', strtotime($dataComment['ccdate'])).' de '.$dataComment['cauthor'].'</small></h6>'; 
		echo '</div>';
		echo '<div class="panel-body">'.$dataComment['ccomment'].'</div>';
	echo '</div>';
} 

if( $_SESSION['user']['type'] == 'admin') { 
	echo "hello";
}
<div class="alert alert-info" role="alert">Le <?php echo date('d-m-Y H:i:s', strtotime($dataComment['ccdate'])); ?> de <?PHP echo $dataComment['cauthor']; ?></div>
*/

?>

<div>Commentaires</div><br>
<?php hile($dataComment = mysql_fetch_assoc($reqComment)) {; ?>
	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h6 class="panel-title"><small>Le <?php echo date('d-m-Y H:i:s', strtotime($dataComment['ccdate'])); ?> de <?php echo $dataComment['cauthor']; ?></small></h6>
		</div>
		<div class="panel-body"> <?php echo $dataComment['ccomment']; ?></div>
	</div>
<?php } ?>

<?php if (isset($_SESSION['user']['type'])) {
	#echo "Connecte";
} ?>
