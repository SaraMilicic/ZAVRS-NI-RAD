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
    <link rel="stylesheet" href="../fontello-72ff7850/css/fontello.css">
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

                if(isset($_SESSION["username"])) {
                    if(isset($_GET['room_id'])) {
                        $_SESSION['room_id'] = $_GET['room_id'];
                        
                        echo '<div class="col-md-4"><a href="reservation_step_one.php?room_id='.$_GET['room_id'].'"><h2 class="active">1. Odabir sobe</h2></a></div>
                        <div class="col-md-4"><a href="reservation_step_two.php" class="not-active"><h2>2. Osobni podaci</h2></a></div>
                        <div class="col-md-4"><a href="reservation_step_three.php" class="not-active"><h2>3. Potvrda rezervacije</h2></a></div>';

                        $room = ORM::for_table('room')->where('room.id', $_SESSION['room_id'])->find_one();
                        $hotel = ORM::for_table('hotel')->where('hotel.id', $room->id_hotel)->find_one();

                        $datetime1 = date_create($_SESSION['date-arrival']);
                        $datetime2 = date_create($_SESSION['date-departure']);
                        $interval = date_diff($datetime1, $datetime2);

                        $price = $room->price * ($interval->d + 1);

                        echo '<div class="col-md-4">
                            <h4>'.$hotel->name.'</h4>
                            <p>'.$room->type.'</p>
                            <p>'.$room->floor.'. kat</p>
                            <p>Datum dolaska: '.date_format(date_create($_SESSION['date-arrival']), 'd.m.Y.').'</p>
                            <p>Datum odlaska: '.date_format(date_create($_SESSION['date-departure']), 'd.m.Y.').'</p>
                            <p>Cijena noćenja: '.$price.' kn</p>
                            <a class="btn btn-primary" href="reservation_step_two.php" style="float:right; width:100%;">Nastavi</a>     
                        </div>';
                    }
                    else {
                        echo 'Odaberite sobu koju želite rezervirati';
                    }
                }
                else {
                    echo 'Za rezervaciju sobe potrebno je ulogirati se u aplikaciju.';
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