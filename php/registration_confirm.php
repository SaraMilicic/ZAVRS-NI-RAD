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
                    $username = $_POST['username_reg'];
                    $password = $_POST['password_reg'];
                    $email = $_POST['email_reg'];

                    $existing_username = ORM::for_table('user')
                    ->where('user.username',$username)
                    ->count();
                    if($existing_username != 0) {
                        echo 'Traženo korisničko ime već postoji. Molimo pokušajte ponovno.<br>';
                        
                    }
                    else {
                        ORM::for_table('user')->find_result_set()
                        ->set('username',$username)
                        ->set('password',$password)
                        ->set('email',$email)
                        ->set('id_role',2)
                        ->save();
                        echo 'Uspješno ste se registrirali.';
                    }
                    echo '<a href="index.php">Povratak na naslovnicu</a>';
                   
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