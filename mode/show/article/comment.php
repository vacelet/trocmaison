<?php	
#-----------------------------------
#
# comment.php : Show all comments related to article
# Author : Nicolas Vacelet
# Last update : 12/07/2016
#
#-----------------------------------

require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 

$reqComment = SQLQuery('SELECT cid,ccomment,cstar,ccdate,cauthor FROM comment WHERE caid = '.$dataArticle['aid'].' AND cpublished = 1 ORDER BY cid');

?>

<div>Commentaires</div><br>
<?php while($dataComment = mysql_fetch_assoc($reqComment)) {; ?>
	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h6 class="panel-title"><small>Le <?php echo date('d-m-Y H:i:s', strtotime($dataComment['ccdate'])); ?> de <strong><?php echo $dataComment['cauthor']; ?></strong></small></h6>
		</div>
		<?php if ($_SESSION['user']['type'] != $dataComment['cauthor']) { ?>
			<div class="panel-body"> <?php echo $dataComment['ccomment']; ?></div>
		<?php } else { ?>
			<form action="index.php?mode=show&category=article&action=update" method="post">
				<!-- hidden -->
				<input type = hidden value = "<?php echo $dataComment['cid']; ?>" name = "cidInput">
				<input type = hidden value = "<?php echo $dataArticle['aname']; ?>" name = "anameInput">
				
				<textarea class="form-control" cols="80" name="commentInput" rows="3"><?php echo $dataComment['ccomment']; ?></textarea>
				<button type="submit" class="btn btn-success btn-xs">Modifier</button>
			</form>
		<?php } ?>
	</div>
<?php } ?>

<?php if (isset($_SESSION['user']['type'])) { ?>
	<hr>
	<form action="index.php?mode=show&category=article&action=insert" method="post">
		<!-- hidden -->
		<input type = hidden value = "<?php echo $dataArticle['aid']; ?>" name = "aidInput">
		<input type = hidden value = "<?php echo $dataArticle['aname']; ?>" name = "anameInput">
		
		<div class="form-group">
			<label >Un commentaire ?</label>
			<textarea class="form-control" cols="80" name="commentInput" rows="3"></textarea>
		</div>
		
		<button type="submit" class="btn btn-success">Sauvegarder</button>
	</form>
<?php } ?>


