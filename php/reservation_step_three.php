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
        <!-- Header and navigation -->
    <header>
        <div class="container-fluid">
            <div class="row header-top">
                <div class="col-md-12" style="float:right;">
                    <nav class="navigation">
                        <ul>
                            <li><a href="#">HR</a></li>
                            <li><a href="#">EN</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6">
                    <a href="index.php" class="logo">BookCroatia</a>
                </div>
                <div class="col-md-6">
                    <nav class="navigation">
                        <ul>
                            <?php 
                                 if(isset($_SESSION["username"])) {
                                     echo "Dobrodošli, " . $_SESSION['username'];
                                     echo '<li><a href="search.php">Rezervacija</a></li>
                                     <li><a href="#">Moja rezervacija</a></li>
                                     <li><a href="logout.php">Odjava</a>';
                                 }
                                 else {
                                     echo "<li><a href='search.php'>Rezervacija</a></li>
                                     <li><a href='#' onclick='show(\"login_form\")''>Prijava</a></li>
                                     <li><a href='#' onclick='show(\"registration_form\")''>Registracija</a></li>
                                     ";
                                 }
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

            

            if(isset($_COOKIE["selected_room_id"])) {

                echo '<div class="col-md-4"><a href="reservation_step_one.php?room_id='.$_COOKIE["selected_room_id"].'">1. Odabir sobe</a></div>
                <div class="col-md-4"><a href="reservation_step_two.php">2. Osobni podaci</a></div>
                <div class="col-md-4"><a href="reservation_step_three.php">3. Potvrda rezervacije</a></div>';
                
                echo $_COOKIE["selected_room_id"];
                echo $_COOKIE["selected_room_arrival"];
                echo $_COOKIE["selected_room_departure"];
            }
            else {
                'Ponovite pretragu';
            }
            

           
            if(isset($_POST['guest_first_name']) && isset($_POST['guest_last_name']) && isset($_POST['guest_passport_number']) && isset($_POST['guest_phone_number']) && isset($_POST['guest_email'])) {

                echo 'u ifu';
                echo '<div class="col-md-12"><h2>3. Potvrda rezervacije</h2></div>';
                $room = ORM::for_table('room')->where('room.id', $_COOKIE["selected_room_id"])->find_one();
                $hotel = ORM::for_table('hotel')->where('hotel.id', $room->id_hotel)->find_one();

                    echo '<div class="col-md-12">
                        <h3>Rezervacija:</h3>
                        <p>Hotel: '.$hotel->name.'</p>
                        Odabrana soba: '.$room->type.'</p>
                        <p>Kat: '.$room->floor.'</p>
                        <p>Datum dolaska: '.$_COOKIE['selected_room_arrival'] .'</p>
                        <p>Datum odlaska: '.$_COOKIE['selected_room_departure'] .'</p>
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
                    /*
                    $_COOKIE["selected_room_id"];
                    $_COOKIE["selected_room_arrival"];
                    $_COOKIE["selected_room_departure"];
                    $_COOKIE["user"];


                    */
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
    </script>
</body>
</html>
