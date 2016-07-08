<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">
  <!-- Meta data Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<?php require_once($_SERVER['DOCUMENT_ROOT']."/include/libraries.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/htmlpage/meta.php"); ?>

  <body>
  
  <div class="container">

    <?php include($_SERVER['DOCUMENT_ROOT']."/htmlpage/menu.php"); ?>
    <?php include($_SERVER['DOCUMENT_ROOT']."/include/message.php"); ?>
    <br>
    <br>
    <br>
    <br>
    <?php include($_SERVER['DOCUMENT_ROOT']."/mode/router.php") ; ?>

  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!-- script src="<?php echo HTTPROOT ?>/dist/bootstrap/js/bootstrap.min.js"></script -->

    <script type="text/javascript">
    $(document).ready(function(){
        
        $('.carousel').carousel();

        
        $( "select[name='subcategoryInput'] option" ).fadeOut();

        $( "select[name='categoryInput']" ).change(function() {
          var value = $( "select[name='categoryInput']" ).val();
          $( "select[name=subcategoryInput] option ").fadeOut();
          //var value = "sortie";
          $( "select[name='subcategoryInput']").children("option[value^=" + value + "]").fadeIn();
         // $( "select[name='subcategoryInput']" ).append(new Option(value, 'foo', true, true));
        });

    });
    </script>

  </body>
</html>