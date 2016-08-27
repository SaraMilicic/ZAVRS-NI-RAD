<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../fontello-fb2fbc05/css/fontello.css">
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
                    <a href="index.html">BookCroatia</a>
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
                            
                            #echo '<li><a href="search.php">Rezervacija</a></li>
                            #<li><a href="#" onclick="show(\"login_form\")">Prijava</a></li>
                            #<li><a href="#">Registracija</a></li>
                            #';
                            
                            echo "<li><a href='search.php'>Rezervacija</a></li>
                            <li><a href='#' onclick='show(\"login_form\")''>Prijava</a></li>
                            <li><a href='#'>Registracija</a></li>
                            ";
                            }
                        ?>
    
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    

  <section class="fluid-container intro" >
        <div class="col-md-4 col-md-offset-8 col-xs-12" id="login_form" style="display:none;" style="background-color:transparent">
            <div class="intro-tekst">
            <form class = "form-signin" role="form" 
             method = "post">
            <h3>Prijava</h3><br>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required><br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>

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
    <div class="container-fluid">
    <h1>Rezultati pretrage</h1>
        <div class="row">
            
        <?php

        require_once 'idiorm.php';
        ORM::configure('mysql:host=localhost:8889;dbname=Booking;charset=utf8');
        ORM::configure('username','root');
        ORM::configure('password','root');

        if (isset($_POST['city-name']) && isset($_POST['date-arrival']) && isset($_POST['date-departure']) && isset($_POST['room-type'])) {
     
            $city_name = $_POST['city-name'];
            $date_arrival = $_POST['date-arrival'];
            $date_departure = $_POST['date-departure'];
            $room_type = $_POST['room-type'];
            $date_arrival_format=date_create("$date_arrival");
            $date_departure_format=date_create("$date_departure");

            //echo date_format($date_arrival_format,"d.m.Y.");
            //echo date_format($date_departure_format,"d.m.Y.");

            echo '<div class="col-md-12">'.$city_name . ' ' . date_format($date_arrival_format,"d.m.Y.") . ' ' . date_format($date_departure_format,"d.m.Y.") . ' ' . $room_type
            .'</div>';




            $number_of_reservation_for_selected_room_type = count(ORM::for_table('reservation')->raw_query('SELECT rsv.* from 
                reservation rsv
                join room r on rsv.id_room = r.id
                where r.type= :type', array('type' => $room_type))->find_many());

            /* Ako za traženi tip sobe ne postoji niti jedna rezervacija, prikaži sve hotele sa traženim tipom soba*/
            if($number_of_reservation_for_selected_room_type == 0) {
                $results = ORM::for_table('hotel')->raw_query('SELECT r.* FROM room r
                join hotel h on r.id_hotel = h.id
                join city c on c.postal_code = h.postal_code
                WHERE c.name = :name and r.type = :type', 
                array('name' => $city_name, 'type' => $room_type))->find_many();

                foreach($results as $result):

                    echo'<div class="col-md-4"> 
                        <h3><a href="#">'.$result->type.'</a></h3>
                        <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                        <h4 style="float:left;">'.$room_type.'</h4>
                        <input type="submit" class="btn btn-primary" value="Rezerviraj" style="float:right;">
                    </div>';


                   /* echo'<div class="col-md-4"> 
                            <h3><a href="hotel.php">'.$hotel_with_selected_room->name.'</a></h3>
                            <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                            <h3><a href="hotel.php" style="float:left;" >'.$result->type.'</a></h3>
                            <input type="submit" class="btn btn-primary" value="Rezerviraj" style="float:right;">
                            <br><h4><a href="hotel.php" style="float:left;">'.$result->price.'</a></h4>
                            
                    </div>';*/
                endforeach;
            }

            /* Ako za traženi tip sobe u odabranom gradu postoji rezervacija, 
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

                $number_of_hotels = count(ORM::for_table('hotel')->raw_query('SELECT h.* from hotel h 
                join room r on h.id = r.id_hotel
                join reservation rsv on rsv.id_room = r.id
                where r.type= :type
                and !((:date_arrival <= rsv.date_departure) and (:date_departure >= rsv.date_arrival))',
                array('type' => $room_type, 'date_arrival' => $date_arrival, 'date_departure' => $date_departure))->find_many()
                );

                if ($results1 == 0 && $results2 == 0) {
                    echo '<h4>Žao nam je, trenutno nema slobodnih soba za traženo razdoblje. Ponovite pretragu s drugim podacima.</h4>';
                }

            foreach($results as $result):
                $hotel_with_selected_room = ORM::for_table('hotel')->raw_query('SELECT h.name FROM hotel h
                join city c on h.postal_code = c.postal_code
                where h.id = :id_hotel
    
                and c.name = :city_name', 
                array('id_hotel' => $result->id_hotel, 'city_name' => $city_name))->find_one();

                if($hotel_with_selected_room == null) {
                    echo '<div class="col-md-12>Žao nam je, rezultati vaše pretrage nisu dali nikakve rezultate. Pokušajte ponovno</div>';
                }
                    $_SESSION['id_room'] = $result->id;
                    $_SESSION['id_hotel'] = $hotel_with_selected_room->id;
                    echo'<div class="col-md-4"> 
                            <h3><a href="hotel.php">'.$hotel_with_selected_room->name.'</a></h3>
                            <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                            <h3><a href="hotel.php" style="float:left;" >'.$result->type.'</a></h3>
                            <input type="submit" class="btn btn-primary" value="Rezerviraj" style="float:right;">
                            <br><h4><a href="hotel.php" style="float:left;">'.$result->price.'</a></h4>
                            
                    </div>';
                endforeach;
            }
        }
        else {
            echo '<br><div class="col-md-12"><h4>Prikazuju se svi naši hoteli. Za suženu pretragu unesite tražene podatke.</h4></div>';
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
        

        
    


 <div style="margin:200px;"></div>

    <?php 
        echo 'session'. $_SESSION['room-type'];
    ?>
   
	
	<footer style="background-color: silver; min-height:100px; margin-top:60px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
            </div>
        </div>
    </footer>
</body>
</html>
