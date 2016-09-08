<?php
    session_start();
    ob_start();
    /*if(isset($_SESSION["username"]) && isset($_SESSION["role"]) && $_SESSION["role"] == 'admin_user') {
        header('Location: admin.php');
    }
    ob_end_flush();*/
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">  
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../fontello-21cce32f/css/fontello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    require_once 'db_conn.php';

                    if(isset($_POST['country_code']) && isset($_POST['name'])) {
                        $country_code = $_POST['country_code'];
                        $name = $_POST['name'];

                        $state = ORM::for_table('state')->create();
                        $state->country_code = $country_code;
                        $state->name = $name;

                        $state->save();

                        echo "Uspješno ste unijeli podatke u bazu.<br>";
                    }
                    

                    
                    echo '<a href="admin.php">Povratak na administratorsku stranicu</a>';
                   
                ?>
            </div>
        </div>
    </div>

    <script>
      function show(target){
        document.getElementById(target).style.display = 'block';
      }
      function hide(target){
        document.getElementById(target).style.display = 'none';
      }
      if(document.getElementById("login_form").style.display === 'block') {
        hide("registration_form");
      }
      else if(document.getElementById("registration_form").style.display === 'block') {
        hide("login_form");
      }
    </script>
</body>
</html>