<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../fontello-21cce32f/css/fontello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
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
    <section class="fluid-container intro-search">
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
    <section class="fluid-container intro-search" >
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

    <!-- Search form -->
    <div class="util-container">
        <div class="container">
            <form class="row form-inline" role="form" method="POST" action="search.php">
                <div class="form-group col-md-4 col-xs-12 main-form-div">
                    <input type="text" class="form-control" id="city-list" placeholder="Grad" list="city-name" required="required" style="width:100%;" name="city-name">
                    <datalist id="city-name">
                    <option value="Zagreb">
                    <option value="Dubrovnik">
                    <option value="Rovinj">
                    <option value="Osijek">
                </div>

                <div class="form-group col-md-2 col-xs-12 main-form-div">
                    <input type="date" class="form-control" id="check-in" data-placeholder="Dolazak" required="required" style="width:100%;" name="date-arrival">
                </div>

                <div class="form-group col-md-2 col-xs-12 main-form-div">
                    <input type="date" class="form-control" id="check-out" data-placeholder="Odlazak" required="required" style="width:100%;" name="date-departure">
                </div>
                
                <div class="form-group col-md-2 col-xs-12 main-form-div">
                    <select class="form-control" id="room-selection" required="required" style="width:100%;" name="room-type">
                        <option value="" disabled selected>Vrsta sobe</option>
                        <option value="Jednokrevetna">Jednokrevetna</option>
                        <option value="Dvokrevetna">Dvokrevetna</option>
                        <option value="Trokrevetna">Trokrevetna</option>
                    </select>
                </div>
                
                <div class="form-group col-md-2 col-xs-12 main-form-div">
                    <input type="submit" class="btn btn-primary" id="search" value="Pretraga"  name="submit" style="width:100%;">
                </div>
            </form>
        </div>
    </div>
    
    <?php 
        if (isset($_POST['submit'])) { 
            $_SESSION['city-name'] = $_POST['city-name'];
            $_SESSION['date-arrival'] = $_POST['date-arrival'];
            $_SESSION['date-departure'] = $_POST['date-departure'];
            $_SESSION['room-type'] = $_POST['room-type'];
        } 
    ?> 
    <div class="container-fluid" style="margin-top:60px;">
    <h1>Rezultati pretrage</h1>
        <div class="row">
            
        <?php

        require_once 'idiorm.php';
        require_once 'db_conn.php';

        if (isset($_POST['city-name']) && isset($_POST['date-arrival']) && isset($_POST['date-departure']) && isset($_POST['room-type'])) {
     
            $city_name = $_POST['city-name'];
            $date_arrival = $_POST['date-arrival'];
            $date_departure = $_POST['date-departure'];
            $room_type = $_POST['room-type'];
            $_SESSION['date_arrival'] = $date_arrival;
            $_SESSION['date_departure'] = $date_departure;

            $date_arrival_format=date_create("$date_arrival");
            $date_departure_format=date_create("$date_departure");

            echo '<div class="col-md-12">'.$city_name . ' ' . date_format($date_arrival_format,"d.m.Y.") . ' ' . date_format($date_departure_format,"d.m.Y.") . ' ' . $room_type
            .'</div>';

            $number_of_reservation_for_selected_room_type = count(ORM::for_table('reservation')->raw_query('SELECT rsv.* from 
                reservation rsv
                join room r on rsv.id_room = r.id
                join hotel h on h.id = r.id_hotel
                join city c on c.postal_code = h.postal_code
                where r.type= :type
                and c.name = :city_name',
                array('type' => $room_type, 'city_name' => $city_name))->find_many());

            /* Ako za traženi tip sobe ne postoji niti jedna rezervacija, prikaži sve hotele sa traženim tipom soba*/
            if($number_of_reservation_for_selected_room_type == 0) {
                $results = ORM::for_table('room')->select_many(array('hotel_name'=>'hotel.name',
                    'room_type'=>'room.type', 'room_price'=>'room.price', 'city_name'=>'city.name'))->
                join('hotel',array('room.id_hotel','=','hotel.id'))->
                join('city',array('city.postal_code','=','hotel.postal_code'))->
                where(array(
                'room.type' => $room_type,
                'city.name' => $city_name))->
                find_many();

                if ($results == null) {
                    echo '<div class="col-md-12"><h4>Žao nam je, trenutno nema slobodnih soba za traženo razdoblje. Ponovite pretragu s drugim podacima.</h4></div>';
                    echo '<div class="col-md-12"><h4>Prikazuju se svi naši hoteli.</h4><br></div>';
                    $all_hotels = ORM::for_table('hotel')->find_many();
                    
                    foreach($all_hotels as $one_hotel):
                        $_SESSION['hotel_id'] = $one_hotel->id;
                        echo'<div class="col-md-4"> 
                            <h3><a href="hotel.php">'.$one_hotel->name.'</a></h3>
                            <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                            <a class="btn btn-primary" href="hotel.php" style="float:right";>Više</a>
                            </div>';
                    endforeach;
                }
                foreach($results as $result):
                    $_SESSION['id_room'] = $result->id;
                    $_SESSION['id_hotel'] = $result->id_hotel;
                    echo'<div class="col-md-4"> 
                        <h3><a href="#">'.$result->hotel_name.'</a></h3>
                        <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/><br>
                        <a class="btn btn-primary" href="reservation.php" style="float:right;">Rezerviraj</a>
                        <h4>'.$result->room_type.' soba</h4>
                        <h4>'.$result->room_price.' kn</h4>
                        <h4>'.$result->city_name.'</h4>  
                    </div>';
                endforeach;
            }

            /* Ako za traženi tip sobe postoji rezervacija, 
            pronađi sve sobe i hotele koje nemaju rezervaciju u tražeom periodu*/
            else {
                $results1 = ORM::for_table('room')->raw_query('SELECT r.* from room r
                join hotel h on r.id_hotel = h.id
                join reservation rsv on r.id = rsv.id_room 
                where r.type= :type
                and !((:date_arrival <= rsv.date_departure) and (:date_departure >= rsv.date_arrival))',
                array('type' => $room_type, 'date_arrival' => $date_arrival, 'date_departure' => $date_departure))->find_many();                
                
                $results2 = ORM::for_table('room')->raw_query('SELECT r.* FROM room r
                join hotel h on r.id_hotel = h.id
                join city c on h.postal_code = c.postal_code
                WHERE c.name = :name and r.type = :type
                and r.id not in(SELECT rsv.id_room FROM reservation rsv)', 
                array('name' => $city_name, 'type' => $room_type))->find_many();

                $results = array_merge($results1, $results2);

                if ($results == null) {
                    echo '<div class="col-md-12"><h4>Žao nam je, trenutno nema slobodnih soba za traženo razdoblje. Ponovite pretragu s drugim podacima.</h4></div>';
                    echo '<div class="col-md-12"><h4>Prikazuju se svi naši hoteli.<br></h4></div>';
                    $all_hotels = ORM::for_table('hotel')->find_many();
                    
                    foreach($all_hotels as $one_hotel):
                        $_SESSION['hotel_id'] = $one_hotel->id;
                        echo'<div class="col-md-4">
                            <h3><a href="hotel.php">'.$one_hotel->name.'</a></h3>
                            <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                            <a class="btn btn-primary" href="hotel.php" style="float:right";>Više</a>
                            </div>';
                    endforeach;
                }

            foreach($results as $result):
                $hotel_with_selected_room = ORM::for_table('hotel')->raw_query('SELECT h.name FROM hotel h
                join city c on h.postal_code = c.postal_code
                where h.id = :id_hotel    
                and c.name = :city_name', 
                array('id_hotel' => $result->id_hotel, 'city_name' => $city_name))->find_one();


                if($hotel_with_selected_room == null) {
                    echo '<div class="col-md-12>Žao nam je, rezultati vaše pretrage nisu dali nikakve rezultate. Pokušajte ponovno<br></div>';
                }
                    $_SESSION['id_room'] = $result->id;
                    $_SESSION['id_hotel'] = $hotel_with_selected_room->id;
                    echo'<div class="col-md-4"> 
                            <h3><a href="hotel.php">'.$hotel_with_selected_room->name.'</a></h3>
                            <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                            <a class="btn btn-primary" href="reservation.php" style="float:right;">Rezerviraj</a>
                            <h4>'.$result->type.' soba</h4>
                            <h4>'.$result->price.' kn</h4>
                            <h4>'.$city_name.'</h4>    
                    </div>';
                endforeach;  
            }
        }
        else {
            echo '<br><div class="col-md-12"><h4>Prikazuju se svi naši hoteli. Za suženu pretragu unesite tražene podatke.<br><br></h4></div>';
            $all_hotels = ORM::for_table('hotel')->find_many();
            
            foreach($all_hotels as $one_hotel):
                echo'<div class="col-md-4"> 
                            <h3><a href="hotel.php">'.$one_hotel->name.'</a></h3>
                            <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                            <input type="submit" class="btn btn-primary" value="Više" style="float:right;">
                    </div>';
            endforeach;
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
