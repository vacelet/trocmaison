<?php 
#________________________________________________________
#
#  Print and reset $_SESSION['message_system']
#
#________________________________________________________
?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); ?>

<?php if (!empty($_SESSION['message_system'])) { ?>

	  <?php switch ($_SESSION['message_system']['type']) {
	    case "error":
	       $message_block = "message-block-error";
	       $message_content = "message-content-error";
	       break;

	    case "warning":
	       $message_block = "message-block-warning";
	       $message_content = "message-content-warning";
	       break;

	    default:
	       $message_block = "message-block-info";
	       $message_content = "message-content-info";
	  }?>

      <div class="row">
        <div class="<?php echo $message_block ?>">
        	<div class="<?php echo $message_content ?>">
        		<?php echo $_SESSION['message_system']['content'] ?>
        	</div>
        </div>
      </div>
      <?php $_SESSION['message_system'] = array(); ?>

<?php } ?>