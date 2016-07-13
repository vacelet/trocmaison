<?php
#-----------------------------------
#
# connection.php : connect user page
# Available only for admin account
# Author : Nicolas Vacelet
# Last update : 16/02/2015
#
#-----------------------------------

 require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); 


#htmlspecialchars
if (isset($_POST['LoginInput']) && isset($_POST['PasswordInput'])){ 
  $_SESSION['user'] = array ('login' => $_POST['LoginInput'], 'password' => $_POST['PasswordInput']);
} else {
  $_SESSION['user'] = array();
}

?>

<?php if( empty ($_SESSION['user']) ) { ?>

  <div class="list-group">
    <a href="#" class="list-group-item active">
      <h4>Connexion</h4>
    </a>
  </div>

  <form action="index.php?mode=connection&category=connection" method="post">
    <div class="form-group">
        <label for="LoginInput">Compte</label>
        <input class="form-control" type="text" placeholder="compte" name="LoginInput">
    </div>
    <div class="form-group">
        <label for="PasswordInput">Mot de passe</label>
        <input class="form-control" type="password" placeholder="mot de passe" name="PasswordInput">
    </div>
      
    <button type="submit" class="btn btn-success">Connexion</button>
  </form>

<?php } else { ?>
    <?php IsLoginValid(); ?>
<?php } ?>




