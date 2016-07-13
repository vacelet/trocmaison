<?php 
#-----------------------------------
#
# libraries.php : store all functions which can be reused
# Author : Nicolas Vacelet
# Last update : 12/07/2016
#
#-----------------------------------

$MODE = "PREPROD";

#PROD
if ($MODE == "PROD") {
  DEFINE ('DB_NAME', 'colaflo'); 
  DEFINE ('DB_PASSWORD', 'Orange06');
  DEFINE ('DB_HOST', '127.0.0.1');
}

#PREPROD
if ($MODE == "PREPROD") {
  #DEFINE ('DB_USER', 'vacelet.nicolas');
  DEFINE ('DB_USER', 'root');
  DEFINE ('DB_PASSWORD', 'root');
  DEFINE ('DB_HOST', '127.0.0.1');
  DEFINE ('DB_NAME', 'colaflo');
}

#Global Variable
DEFINE ('GOOGLE_MAP_HOME_LATLNG', '43.62107,6.93520');
DEFINE ('HTTPROOT', "http://".$_SERVER['SERVER_NAME']);
DEFINE ('DOCUMENTROOT', getenv("DOCUMENT_ROOT"));
#$HTTPROOT= "http://".$_SERVER['SERVER_NAME'];
#$DOCUMENTROOT = getenv("DOCUMENT_ROOT") ;
date_default_timezone_set('Europe/Paris');

#
# Connect to SQL
function SQLConnect() {
  $link =  mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Impossible de se connecter : " . mysql_error());
  mysql_select_db(DB_NAME,$link);
  return $link;
}

#
# Close SQL
#
function SQLClose($link) {
  mysql_close($link);
}

#
# Query SQL
#
function SQLQuery($sql) {
  $link = SQLConnect();
  $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
  SQLClose($link);
  return $req;
}

# If login is exist then 
# seed $_SESSION['user'] and $_SESSION['message_system'] = info, 
# else 
# reset $_SESSION['user'] and $_SESSION['message_system'] = error
#
function IsLoginValid () {
  
  $sql = 'SELECT llogin, lpassword, lsalt, llevel, lcomment FROM login WHERE llogin = "'.$_POST['LoginInput'].'" AND lpassword = "'.md5($_POST['PasswordInput']).'" AND lavailable = 1 LIMIT 1'; 
  $req = SQLQuery($sql);
  $data = mysql_fetch_assoc($req);

  if ( !empty($data) ) {
    $_SESSION['message_system'] = array('type' => 'info', "content" => " Vous &ecirc;tes connect&eacute;.");
    $_SESSION['user'] = array('user' => $data["llogin"], 'password' => True, 'type' => $data["llevel"], 'comment' => $data["lcomment"] );
    insertLog("Authentification avec succés", "success");
    RedirectToIndex(HTTPROOT);
  } else {
    $_SESSION['message_system'] = @array('type' => 'error', "content" => "Erreur : veuillez resaisir votre compte et votre mot de passe.");
    $_SESSION['user'] = array();
    insertLog("Erreur : tentative de connection de ".$_POST['LoginInput'], "danger");
    RedirectToIndex(HTTPROOT."/index.php?mode=connection&category=connection");
  }

} 

#
# Logout and reset session variables 
#
function Disconnect() {
  $_SESSION = array();
  $_SESSION['message_system'] = @array('type' => 'info', "content" => "Vous &ecirc;tes d&eacute;connect&eacute;. Merci de votre visite");
  RedirectToIndex(HTTPROOT);
}

#
# Redirect to index using string $url 
#
function RedirectToIndex($url) {
  echo '<script language="Javascript">
    <!--
      document.location.replace("'.$url.'");
    // -->
  </script>';
} 

#
# Insert article data
#
function insertArticle(){
  $sql = 'INSERT INTO article (aid, aname, apublished, acategory, asubcategory, atitle, acontent, aaddress, amap, atags, aupdate)  
    VALUES ("",
    "'.($_POST['anameInput']).'",
    "'.$_POST['publishedInput'].'",
    "'.$_POST['categoryInput'].'",
    "'.$_POST['subcategoryInput'].'",
    "'.($_POST['titleInput']).'",
    "'.htmlspecialchars($_POST['contentInput']).'",
    "'.htmlspecialchars($_POST['addressInput']).'",
    "'.$_POST['amapInput'].'",
    "",
    "")';
  SQLQuery($sql);

  $sql = 'SELECT aid FROM article WHERE aname = "'.$_POST['anameInput'].'"';
  $reqArticle = SQLQuery($sql);
  $article = mysql_fetch_assoc($reqArticle);

  updateTagRelatedToArticle($_POST['atagInput'], $article['aid']);

  insertLog("Article ".$_POST['anameInput']." a été créé", "success");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['titleInput']." a &eacute;t&eacute; sauvegard&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=article&action=list");
}

#
# Update article data
#
function updateArticle(){
  $sql = 'UPDATE article SET
    atitle = "'.$_POST['titreInput'].'",
    apublished = "'.$_POST['publishedInput'].'",
    acategory = "'.$_POST['categoryInput'].'",
    asubcategory = "'.$_POST['subcategoryInput'].'",
    acontent = "'.htmlspecialchars($_POST['contentInput']).'",
    aaddress = "'.htmlspecialchars($_POST['addressInput']).'",
    amap = "'.$_POST['amapInput'].'",
    atags = ""
    WHERE aid = '.$_POST['aidInput'].' LIMIT 1';
  #echo $sql;
  #exit;
  SQLQuery($sql);

  updateTagRelatedToArticle($_POST['atagInput'], $_POST['aidInput']);

  insertLog("Article ".$_POST['titreInput']." a été mis a jour", "success");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['titreInput']." a &eacute;t&eacute; sauvegard&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=article&action=list");
}

#
# Record tag in tag_article table
#
function updateTagRelatedToArticle($SelectedTag, $ArticleID){
  $sql = 'DELETE FROM tag_article WHERE ta_aid = '.$ArticleID;
  SQLQuery($sql);

  #print_r($SelectedTag);

  if (!empty($SelectedTag)) {
    #print_r($SelectedTag);

    foreach ($SelectedTag as $tag) {
      $sql = 'SELECT tid FROM tag WHERE tname = "'.$tag.'"';
      $reqTag = SQLQuery($sql);
      $Tag = mysql_fetch_assoc($reqTag);

      $sql = 'INSERT INTO tag_article (ta_tid, ta_aid) VALUES ("'.$Tag["tid"].'", "'.$ArticleID.'")';
      SQLQuery($sql);
    }
  }
  
}

#
# Delete article data
#
function deleteArticle(){
  $sql = 'DELETE FROM article WHERE aid = '.$_POST['aidInput'];
  SQLQuery($sql);

  $sql = 'DELETE FROM tag_article WHERE ta_aid = '.$_POST['aidInput'];
  SQLQuery($sql);

  insertLog("Article ".$_POST['titreInput']." a été supprimé", "warning");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['titleInput']." a &eacute;t&eacute; supprim&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=article&action=list");
}

#
# Save user data 
#
function updateUser(){
  $sql = 'UPDATE login SET 
    llogin = "'.$_POST['loginInput'].'",
    lavailable = "'.$_POST['availableInput'].'",
    llevel = "'.$_POST['levelInput'].'",
    lcomment = "'.$_POST['commentInput'].'" 
    WHERE lid = '.$_POST['lidInput'].' LIMIT 1';
  SQLQuery($sql);

  insertLog("L'utilisateur ".$_POST['loginInput']." a été mis a jour", "success");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['loginInput']." a &eacute;t&eacute; sauvegard&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=user&action=list");
}

#
# Insert user data
#
function insertUser(){
#INSERT INTO `article` (`aid`, `aname`, `apublished`, `acategory`, `asubcategory`, `atitle`, `acontent`, `aaddress`, `amap`, `atags`, `aupdate`) 
#VALUES ('', 'ty', '0', 'rt', 'rt', 'rt', 'rt', '1,2', 'rt', 'tag', '0000-00-00 00:00:00.000000')
  $salt = crypt(md5($_POST['passwordInput']), rand(5, 15));
  $sql = 'INSERT INTO login (lid, llogin, lpassword, lsalt, lavailable, llevel, lcomment)  
    VALUES ("",
    "'.($_POST['loginInput']).'",
    "'.md5( ($_POST['passwordInput']) ).'",
    "'.$salt.'",
    "'.$_POST['availableInput'].'",
    "'.$_POST['levelInput'].'",
    "'.$_POST['commentInput'].'"
    )';
  SQLQuery($sql);

  insertLog("L'utilisateur ".$_POST['loginInput']." a été créé", "success");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['loginInput']." a &eacute;t&eacute; sauvegard&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=user&action=list");
}

#
# Delete user data
#
function deleteUser(){
  $sql = 'DELETE FROM login WHERE lid = '.$_POST['lidInput'];
  SQLQuery($sql);

  insertLog("L'utilisateur ".$_POST['loginInput']." a été supprimé", "warning");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['loginInput']." a &eacute;t&eacute; supprim&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=user&action=list");
}

#
# Save tag data 
#
function updateTag(){
  $sql = 'UPDATE tag SET 
    tname = "'.$_POST['tnameInput'].'",
    tcomment = "'.$_POST['tcommentInput'].'"
    WHERE tid = '.$_POST['tidInput'].' LIMIT 1';
  SQLQuery($sql);

  insertLog("Le tag ".$_POST['tnameInput']." a été mis a jour", "success");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['tnameInput']." a &eacute;t&eacute; sauvegard&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=tag&action=list");
}


#
# Insert tag data
#
function insertTag(){
#INSERT INTO `article` (`aid`, `aname`, `apublished`, `acategory`, `asubcategory`, `atitle`, `acontent`, `aaddress`, `amap`, `atags`, `aupdate`) 
#VALUES ('', 'ty', '0', 'rt', 'rt', 'rt', 'rt', '1,2', 'rt', 'tag', '0000-00-00 00:00:00.000000')
  $sql = 'INSERT INTO tag (tname, tcomment)  
    VALUES ("'.($_POST['tnameInput']).'",
    "'.$_POST['tcommentInput'].'"
    )';
  SQLQuery($sql);

  insertLog("Le tag ".$_POST['tnameInput']." a été créé", "success");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['tnameInput']." a &eacute;t&eacute; sauvegard&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=tag&action=list");
}

#
# Delete tag data
#
function deleteTag(){
  $sql = 'DELETE FROM tag WHERE tid = '.$_POST['tidInput'];
  SQLQuery($sql);

  $sql = 'DELETE FROM tag_article WHERE ta_tid = '.$_POST['tidInput'];
  SQLQuery($sql);

  insertLog("Le tag ".$_POST['tnameInput']." a été supprimé", "warning");

  $_SESSION['message_system'] = array('type' => 'info', "content" => $_POST['tnameInput']." a &eacute;t&eacute; supprim&eacute.");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=tag&action=list");
}

#
# Print tag into article view
#
function printTags($aid) {
  $SelectedTag = "";
  $sql = 'SELECT tname FROM tag, tag_article WHERE ta_aid = '.$aid.' AND ta_tid = tid'; 
  $reqTagRelatedToArticle = SQLQuery($sql);
  #echo '<div class="form-inline btn-group inline pull-left">'; 
  while($TagRelatedToArticle = mysql_fetch_assoc($reqTagRelatedToArticle)) {
    $SelectedTag .= '<form action="index.php?mode=show&category=tag&action=list" method="post" class="form-tag-inline">';
      $SelectedTag .= '<input type = "hidden" value = "'.$TagRelatedToArticle["tname"].'" name = "tnameInput">';
      $SelectedTag .= '<button type= "submit" class="btn btn-default btn-xs">'.$TagRelatedToArticle["tname"].'</button>';
    $SelectedTag .= '</form>';
    #$SelectedTag .= '<a href="'.HTTPROOT.'/index.php?mode=show&category=tag&action=list">'.$TagRelatedToArticle["tname"].'</a> ';
  }
  #echo '</div>';
  return $SelectedTag;
}

#
# Print tag into article view
#
function getTagsList($aid) {
  $SelectedTag = "";
  $sql = 'SELECT tname FROM tag, tag_article WHERE ta_aid = '.$aid.' AND ta_tid = tid'; 
  $reqTagRelatedToArticle = SQLQuery($sql);
  #echo '<div class="form-inline btn-group inline pull-left">'; 
  while($TagRelatedToArticle = mysql_fetch_assoc($reqTagRelatedToArticle)) {
    $SelectedTag .= '<form action="index.php?mode=show&category=tag&action=list" method="post" class="form-tag-inline">';
      $SelectedTag .= '<input type = "hidden" value = "'.$TagRelatedToArticle["tname"].'" name = "tnameInput">';
      $SelectedTag .= '<button type= "submit" class="btn btn-default btn-xs">'.$TagRelatedToArticle["tname"].'</button>';
    $SelectedTag .= '</form>';
    #$SelectedTag .= '<a href="'.HTTPROOT.'/index.php?mode=admin&category=tag&action=list">'.$TagRelatedToArticle["tname"].'</a> ';
  }
  #echo '</div>';
  return $SelectedTag;
}

#
# Record log
#
function insertLog($msg, $alerte="info"){
  $today = date("Y-m-j H:i:s");
  $sql = 'INSERT INTO log (lid, lmessage, laccount, lalert, ldate) VALUES ("", "'.$msg.'", "'.$_SESSION['user']['user'].'", "'.$alerte.'","'.$today.'")';
  SQLQuery($sql);
}

#
# Delete log
#
function deleteLog(){
  if ( empty($_POST['lidInput']) ) {
    $sql = 'DELETE FROM log';
    $msg = "Suppression de toutes les logs";
  } else {
    $sql = 'DELETE FROM log WHERE lid = '.$_POST['lidInput'];
    $msg = NULL;
  }
  SQLQuery($sql);

  if ( !empty($msg) ) { insertLog($msg, "danger"); }

  $_SESSION['message_system'] = array('type' => 'info', "content" => " Les messages ont &eacutet&eacute supprim&eacutes. ");
  RedirectToIndex(HTTPROOT."/index.php?mode=admin&category=log&action=list");
}

#
# Insert comment
#
function insertComment(){
  $user = $_SESSION['user']['user'];
  
  if ( empty($_POST['commentInput']) ) {
	  $_SESSION['message_system'] = array('type' => 'warning', "content" => "Votre commentaire n'a pas &eacutet&eacute enregistr&eacute car il est est vide.");
  } else {
	  $sql = 'INSERT INTO comment (cid, caid, ccomment, cpublished, cstar, ccdate, cauthor)  
		VALUES (NULL,
		"'.($_POST['aidInput']).'",
		"'.$_POST['commentInput'].'",
		"1",
		"0",
		"'.date("Y-m-j H:i:s").'",
		"'.$user.'"
		)';
	  SQLQuery($sql);
	  
	  insertLog("Le commentaire de moi a été enregistr&eacute par ".$user, "success");
	  $_SESSION['message_system'] = array('type' => 'info', "content" => "Votre commentaire a &eacute;t&eacute; pris en compte.");
  }
  RedirectToIndex(HTTPROOT."/index.php?mode=show&category=article&action=view&name=".$_POST['anameInput']);
}

#
# Update comment
#
function updateComment(){
  $user = $_SESSION['user']['user'];
	
  if ( empty($_POST['commentInput']) ) {
	  $_SESSION['message_system'] = array('type' => 'warning', "content" => "Votre commentaire n'a pas &eacutet&eacute enregistr&eacute car il est est vide.");
  } else {
    $sql = 'UPDATE comment SET 
      ccomment = "'.$_POST['commentInput'].'"
      WHERE cid = '.$_POST['cidInput'].' LIMIT 1';
    SQLQuery($sql);

    insertLog("Un commentaire a été mis a jour par ".$user, "success");

    $_SESSION['message_system'] = array('type' => 'info', "content" => "Votre commentaire a &eacute;t&eacute; pris en compte.");
  }
  RedirectToIndex(HTTPROOT."/index.php?mode=show&category=article&action=view&name=".$_POST['anameInput']);
}

#
# init google map acording lat and long 
#
function InitGoogleMap($amap){
  if ($amap) {
    echo '
    <script>
      function initialize() {
        var centerPoint = new google.maps.LatLng('.$amap.');
        var mapProp = {
          center: centerPoint,
          zoom:11,
          scaleControl: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var marker = new google.maps.Marker({ 
          position: centerPoint, 
          zIndex: 1
        });
        marker.setMap(map);
        var homePosition = new google.maps.LatLng('.GOOGLE_MAP_HOME_LATLNG.');
        var home = new google.maps.Marker({ 
          position: homePosition,
          icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 5
          },
          title: "Maison",
          zIndex: 2
        });
        home.setMap(map);
      }

      function loadScript() {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
        document.body.appendChild(script);
      }

      window.onload = loadScript;
    </script>
    ';
  };
}


?>
