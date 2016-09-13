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
            <div class="intro-registration-step">
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
                    echo '<div class="col-md-4"><a href="reservation_step_one.php?room_id='.$_SESSION['room_id'].'"><h2>1. Odabir sobe</h2></a></div>
                        <div class="col-md-4"><a href="reservation_step_two.php"><h2>2. Osobni podaci</h2></a></div>
                        <div class="col-md-4"><a href="reservation_step_three.php" class="active"><h2>3. Potvrda rezervacije</h2></a></div>';                           
                }
                else {
                    'Ponovite pretragu';
                }
                
                if(isset($_POST['guest_first_name']) && isset($_POST['guest_last_name']) && isset($_POST['guest_passport_number']) && isset($_POST['guest_phone_number']) && isset($_POST['guest_email'])) {
                    $room = ORM::for_table('room')->where('room.id', $_SESSION['room_id'])->find_one();
                    $hotel = ORM::for_table('hotel')->where('hotel.id', $room->id_hotel)->find_one();

                        echo '<div class="col-md-4 col-md-offset-8">
                            <h3>Rezervacija:</h3>
                            <p>Hotel: '.$hotel->name.'</p>
                            Odabrana soba: '.$room->type.'</p>
                            <p>Kat: '.$room->floor.'</p>
                            <p>Datum dolaska: '.$_SESSION['date-arrival'].'</p>
                            <p>Datum odlaska: '.$_SESSION['date-departure'] .'</p>
                            <p>Cijena noćenja: '.$room->price.'</p>

                            <h3>Odobni podaci</h3>
                            <p>Ime: '.$_POST['guest_first_name'].'</p>
                            <p>Prezime: '.$_POST['guest_last_name'].'</p>
                            <p>Broj putovnice: '.$_POST['guest_passport_number'].'</p>
                            <p>Broj telefona: '.$_POST['guest_phone_number'].'</p>
                            <p>Email: '.$_POST['guest_email'].'</p>

                        </div>';

                        $_SESSION['guest_first_name'] = $_POST['guest_first_name'];
                        $_SESSION['guest_last_name'] = $_POST['guest_last_name'];
                        $_SESSION['guest_passport_number'] = $_POST['guest_passport_number'];
                        $_SESSION['guest_phone_number'] = $_POST['guest_phone_number'];
                        $_SESSION['guest_email'] = $_POST['guest_email'];

                        echo '<a class="btn btn-primary" href="reservation_confirm.php" style="float:right";>Potvrdi rezervaciju</a>'; 
                }
                else {
                    echo 'Ponovite pretragu.';
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