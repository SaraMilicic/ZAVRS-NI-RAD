<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../fontello-fb2fbc05/css/fontello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
    <!-- Header and navigation -->
    <header>
        <div class="container-fluid">
            <div class="row header-top">   
                <div class="col-md-6 col-xs-12">
                    <a href="index.php" class="logo">BookCroatia</a>
                </div>
                <div class="col-md-6 col-xs-12">
                    <nav class="navigation">
                        <ul>
                            <?php
                                require_once 'login.php';
                                ob_end_flush();
                            ?> 
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Login form - visible on click for button "Prijava"-->
    <section class="fluid-container">
        <div class="col-md-4 col-md-offset-8 col-xs-12" id="login_form" style="display:none;" style="background-color:transparent">
            <div class="intro-login">
                <i class="icon-cancel-circled2 cancel-icon" onclick="hide('login_form')"></i>
                <form class="form-signin" role="form" method="post">
                    <h3>Prijava</h3><br>
                    <input type="text" class="form-control" name="username" placeholder="username" required autofocus></br>
                    <input type="password" class="form-control" name="password" placeholder="password" required><br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Prijava</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Registration form -->
    <section class="fluid-container" >
        <div class="col-md-4 col-md-offset-8 col-xs-12" id="registration_form" style="display:none;" style="background-color:transparent">
            <div class="intro-registration">
                <i class="icon-cancel-circled2 cancel-icon" onclick="hide('registration_form')"></i>
                <form class="form-registration" role="form" method="POST" action="registration_confirm.php">
                    <h3>Registracija</h3><br>
                    <input type="text" class="form-control" name="username_reg" placeholder="username" required autofocus></br>
                    <input type="password" class="form-control" name="password_reg" placeholder="password" required><br>
                    <input type="email" class="form-control" name="email_reg" placeholder="email" required><br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="registration">Registracija</button>
                </form>
            </div>
        </div>
    </section>


   <div class="container">
        <div class="row">
            <?php
                require_once 'idiorm.php';
                require_once 'db_conn.php';

                if(isset($_SESSION['room_id'])) {
                    echo '<h2>Informacije o rezervaciji</h2>';
                }
                else {
                    'Ponovite pretragu';
                }
                
                if(isset($_SESSION['room_id']) && isset($_SESSION["username"]) 
                    && isset($_SESSION['date-arrival']) && isset($_SESSION['date-departure'])
                    && isset($_SESSION['guest_first_name']) && isset($_SESSION['guest_last_name']) 
                    && isset($_SESSION['guest_passport_number']) && isset($_SESSION['guest_phone_number']) 
                    && isset($_SESSION['guest_email'])) {
                    
                    $guest = ORM::for_table('guest')->create();

                    $user = ORM::for_table('user')->where('user.username', $_SESSION["username"])->find_one();

                    $guest->first_name =  $_SESSION['guest_first_name'];
                    $guest->last_name =  $_SESSION['guest_last_name'];
                    $guest->passport_number =  $_SESSION['guest_passport_number'];
                    $guest->phone_number =  $_SESSION['guest_phone_number'];
                    $guest->email =  $_SESSION['guest_email'];               
                    $guest->save();
                           
                    $reservation = ORM::for_table('reservation')->create();
                    $reservation->date_arrival = $_SESSION["date-arrival"];
                    $reservation->date_departure = $_SESSION["date-departure"];
                    $reservation->id_room = $_SESSION["room_id"];
                    $reservation->id_guest = $guest->id;
                    $reservation->id_user = $user->id;
                    $reservation->save();

                    echo 'Uspješno ste rezervirali željenu sobu. Svoju rezervaciju možete vidjeti na stranici "Moja rezervacija"';
                }
                else {
                    echo "Imamo tehničkih problema. Molimo Vas pokušajte kasnije.";
                }

            ?>
        </div>
    </div>

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
            </div>
        </div>
    </footer>

    <script>
      function show(target){
        document.getElementById(target).style.display = 'block';
      }
      function hide(target){
        document.getElementById(target).style.display = 'none';
      }
      function showLogin() {
        show("login_form");
        hide("registration_form");
      }
      function showRegistration() {
        show("registration_form");
        hide("login_form");
      }
    </script>
</body>
</html>
