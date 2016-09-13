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

                if(isset($_SESSION['username'])) {
                    $results = ORM::for_table('reservation')->select_many(array('rsv_date_arrival'=>'reservation.date_arrival', 'rsv_date_departure'=>'reservation.date_departure', 'rsv_id_room'=>'reservation.id_room', 'rsv_id_guest'=>'reservation.id_guest', 'rsv_id_user'=>'reservation.id_user', 'hotel_name'=>'hotel.name', 'city_name'=>'city.name', 'guest_first_name'=>'guest.first_name', 'guest_last_name'=>'guest.last_name', 'guest_passport_number'=>'guest.passport_number', 'guest_phone_number'=>'guest.phone_number', 'room_id'=>'room.id', 'room_id_hotel'=>'room.id_hotel', 'room_type'=>'room.type', 'room_price'=>'room.price'))->
                    join('room',array('reservation.id_room', '=', 'room.id'))->
                    join('hotel',array('room.id_hotel', '=', 'hotel.id'))->
                    join('city',array('city.postal_code', '=', 'hotel.postal_code'))->
                    join('guest',array('guest.id', '=', 'reservation.id_room'))->
                    join('user',array('user.id', '=', 'reservation.id_user'))->
                    where('user.username', $_SESSION['username'])-> 
                    find_many();

                    echo '<div class="col-md-12>
                        <h1>Moja rezervacija</h1>';
                        
                    if($result != null) {
                        foreach($results as $result) {
                        echo'<h2>Informacije o smještaju</h2>
                        </div>';
                        echo
                            '<p>'.$result->hotel_name.'</p>'.
                            '<p>'.$result->room_type.'</p>'.
                            '<p>'.$result->rsv_date_arrival.'</p>'.
                            '<p>'.$result->rsv_date_departure.'</p>'.
                            '<p>'.$result->room_price * (date_diff($result->rsv_date_arrival, $result->rsv_date_departure)->d + 1).'</p>';
                    }

                    echo '<div class="col-md-12>
                        <h2>Informacije o gostima</h2>
                        </div>';

                    foreach($results as $result) {
                        echo
                            '<p>'.$result->guest_first_name.'</p>'.
                            '<p>'.$result->guest_last_name.'</p>'.
                            '<p>'.$result->guest_passport_number.'</p>';
                            '<p>'.$result->guest_phone_number.'</p>';              
                    }
                    }
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