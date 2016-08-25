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
        <!-- <div class="container-fluid intro-search"> -->
        <div class="container-fluid intro-search">
            <div class="row header-top">
                <div class="col-md-6">
                    <a href="index.html">BookCroatia</a>
                </div>
                <div class="col-md-6">
                    <nav class="navigation">
                        <ul>
                            <li><a href="#">Rezervacija</a></li>
                            <li><a href="#">Prijava</a></li>
                            <li><a href="#">Registracija</a></li>
                            <li><a href="#">HR</a></li>
                            <li><a href="#">EN</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
        
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
                    <input type="submit" class="btn btn-primary" id="search" value="Pretraga" style="width:100%;">
                </div>
            </form>
        </div>
    </div>
    

   
    <!-- <div class="util-container" style="background:beige;">
        <div class="container">
            <form class="row form-inline" role="form">
                <h2>Razvrstaj po:</h2>


                <div class="form-group col-md-12 col-xs-12" >
                    <img src="../images/demograf_filters.png" style="width:100%; float:left" />
                </div>
                <div class="form-group col-md-12 col-xs-12">
                    <h3>Kategorija:</h3>
                    <input type="checkbox" /><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><br>
                    <input type="checkbox" /><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><br>
                    <input type="checkbox" /><i class="icon-star-filled"></i><i class="icon-star-filled"></i></i><br>
                    <input type="checkbox" /><i class="icon-star-filled"></i></i><br>
                </div>
            </form>
        </div>
    </div> -->

    <div class="container-fluid">
    <h1>Rezultati pretrage</h1>
        <div class="row">
            









        <?php


        $city_name = $_POST['city-name'];
        $date_arrival = $_POST['date-arrival'];
        $date_departure = $_POST['date-departure'];
        //$room_type = $_POST['room-type']     . ' ' . $room_type;
        //$room_type="Dvokrevetna";
        $room_type = $_POST['room-type'];
        $date_arrival_format=date_create("$date_arrival");
        $date_departure_format=date_create("$date_departure");

        echo date_format($date_arrival_format,"d.m.Y.");
        echo date_format($date_departure_format,"d.m.Y.");

        echo '<div class="col-md-12">'.$city_name . ' ' . $date_arrival . ' ' . $date_departure . ' ' . $room_type
        .'</div>';

        

        require_once 'idiorm.php';
        ORM::configure('mysql:host=localhost:8889;dbname=Booking;charset=utf8');
        ORM::configure('username','root');
        ORM::configure('password','root');

        /* Koliko rezervacija postoji za traženi tip sobe u odabranom gradu*/
        $number_of_reservation_for_selected_room_type = count(ORM::for_table('reservation')->raw_query('SELECT rsv.* from 
            reservation rsv
            join room r on rsv.id_room = r.id
            where r.type= :type', array('type' => $room_type))->find_many());
        //echo $number_of_reservation_for_selected_room_type;

        /* Ako za traženi tip sobe ne postoji niti jedna rezervacija, prikaži sve hotele sa traženim tipom soba*/
        if($number_of_reservation_for_selected_room_type == 0) {
            $results = ORM::for_table('hotel')->raw_query('SELECT h.* FROM hotel h
            join city c on h.postal_code = c.postal_code
            join room r on h.id = r.id_hotel

            WHERE c.name = :name and r.type = :type', 
            array('name' => $city_name, 'type' => $room_type))->find_many();

        
        
            foreach($results as $result):

                echo '<h3><a href="#">'.$result->name.'</a></h3>';
                echo '<img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>';
                
                /*echo '<h4 style="float:left;">'.$result->about.'</h4>';*/
                echo '<h4 style="float:left;">'.$room_type.'</h4>';
                echo '<input type="submit" class="btn btn-primary" value="Rezerviraj" style="float:right;">';


                    

            endforeach;
        }


        /* Ako za traženi tip sobe u odabranom gradu postoji rezervacija, 
        pronađi sve sobe i hotele koje nemaju rezervaciju u tražeom periodu*/
        else {

            $results1 = ORM::for_table('hotel')->raw_query('SELECT h.*, r.* from hotel h 
            join room r on h.id = r.id_hotel
            join reservation rsv on rsv.id_room = r.id
            where r.type= :type
            and !((:date_arrival <= rsv.date_departure) and (:date_departure >= rsv.date_arrival))',
            array('type' => $room_type, 'date_arrival' => $date_arrival, 'date_departure' => $date_departure))->find_many();
            
            

            $results2 = ORM::for_table('hotel')->raw_query('SELECT h.*, r.* FROM hotel h
            join city c on h.postal_code = c.postal_code
            join room r on h.id = r.id_hotel
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

                echo'<div class="col-md-4"> 
                        <h3><a href="hotel.php">'.$result->name.'</a></h3>

                        <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                        <h4 style="float:left;">'.$room_type.' soba</h4>
                        <input type="submit" class="btn btn-primary" value="Rezerviraj" style="float:right;">
                </div>';

                /*echo '<h3><a href="#">'.$result->name.'</a></h3>';
                echo '<img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>';*/

                /*echo '<h4 style="float:left;">'.$result->about.'</h4>';*/
                /*echo '<h4 style="float:left;">'.$room_type.'</h4>';
                echo '<input type="submit" class="btn btn-primary" value="Rezerviraj" style="float:right;">';*/
                

            endforeach;

        
        }
        

    /*
        Two date range overlaping:
        (StartA <= EndB)  and  (EndA >= StartB)
        (StartDate1 <= EndDate2) and (StartDate2 <= EndDate1)*/

    ?>










            
            
        </div>
    </div>
    
   

 <!--
    <div class="container">
    <h1>Rezultati pretrage</h1>
        <div class="row">
            <div class="col-md-6">
                <h3><a href="#">Hotel</a></h3>
                <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                <p>Opis</p>
            </div>
            <div class="col-md-6">
                <h3><a href="#">Hotel</a></h3>
                <img src="../images/bulow-palais-534561.jpg" style="width:100%; height:400px;"/>
                <p>Opis</p>
            </div>
            
        </div>
    </div>

    <div class="container-fluid">
    <h1>Rezultati pretrage</h1>
        <div class="row">
            <div class="col-md-3">
                <h3><a href="#">Hotel</a></h3>
                <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                <p>Opis</p>
            </div>
            <div class="col-md-3">
                <h3><a href="#">Hotel</a></h3>
                <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                <p>Opis</p>
            </div>
            <div class="col-md-3">
                <h3><a href="#">Hotel</a></h3>
                <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                <p>Opis</p>
            </div>
            <div class="col-md-3">
                <h3><a href="#">Hotel</a></h3>
                <img src="../images/accommdation-992296.jpg" style="width:100%; height:400px;"/>
                <p>Opis</p>
            </div>
        </div>
    </div>
    
    -->

    <!--
    <div class="container" style="border: 1px solid silver;">


 
        <div class="row">
            <div class="col-md-12" style="border: 1px solid silver;">
                <h3><a href="#">Hotel<i class="icon-right-open-big"></i></a></h3>
                <img src="../images/bulow-palais-534561.jpg" style="width:50%;float:left;" />
                <p style="width:50%; float:right; text-align:left; padding-left:10px;">
                Umami actually tumblr +1 fingerstache echo park. Vice authentic cray single-origin coffee, post-ironic squid everyday carry. Butcher gluten-free bespoke, sustainable affogato blog tofu chicharrones heirloom distillery next level forage meditation truffaut mumblecore.
                </p>
            </div>
            
             
        </div>
    </div>


        <div style="margin:200px;"></div>


    <div class="container-fluid" style="border: 1px solid silver;">
        <div class="row">
            <div class="col-md-6" style="border: 1px solid silver;">
                <h3><a href="#">Hotel<i class="icon-right-open-big"></i></a></h3>
                <img src="../images/bulow-palais-534561.jpg" style="width:50%;float:left;" />
                <p style="width:50%; float:right; text-align:left; padding-left:10px;">
                Umami actually tumblr +1 fingerstache echo park. Vice authentic cray single-origin coffee, post-ironic squid everyday carry. Butcher gluten-free bespoke, sustainable affogato blog tofu chicharrones heirloom distillery next level forage meditation truffaut mumblecore.
                </p>
                <input type="submit" class="btn btn-primary" id="reservation" value="Rezerviraj" style="margin-left:10px;">
            </div>
            <div class="col-md-6" style="border: 1px solid silver;">
                <h3><a href="#">Hotel<i class="icon-right-open-big"></i></a></h3>
                <img src="../images/bulow-palais-534561.jpg" style="width:50%;float:left;" />
                <p style="width:50%; float:right; text-align:left; padding-left:10px;">
                Umami actually tumblr +1 fingerstache echo park. Vice authentic cray single-origin coffee, post-ironic squid everyday carry. Butcher gluten-free bespoke, sustainable affogato blog tofu chicharrones heirloom distillery next level forage meditation truffaut mumblecore.
                </p>
            </div>
        </div>
    </div>

        -->


 <div style="margin:200px;"></div>


    <!-- <div class="container-fluid" style="border: 1px solid silver;">


        Col-md-3
        <div class="row">
            <div class="col-md-3" style="border: 1px solid silver;">
                <h3><a href="#">Hotel<i class="icon-right-open-big"></i></a></h3>
                <img src="../images/bulow-palais-534561.jpg" class="city-image" />
                
            </div>
            
            <div class="col-md-3" style="border: 1px solid silver;">
                <p>Umami actually tumblr +1 fingerstache echo park. Vice authentic cray single-origin coffee, post-ironic squid everyday carry. Butcher gluten-free bespoke, sustainable affogato blog tofu chicharrones heirloom distillery next level forage meditation truffaut mumblecore.
                </p>
            </div>         

            <div class="col-md-3" style="border: 1px solid silver;">
                <h3><a href="#">Hotel<i class="icon-right-open-big"></i></a></h3>
                <img src="../images/hotel-1023473.jpg" class="city-image" />
                
            </div>

            <div class="col-md-3" style="border: 1px solid silver;"></div>  
        </div>
    </div> -->






	<!--

	<div class="container-fluid">
		<div class="row" style="margin-top:60px;">
            <h2>Razvrstaj po:</h2>
			<div class="col-md-2" style="border:1px solid gray;">
				<div>
					<h3>Cijena:</h3>
					<input type="checkbox" /> HRK 0 - HRK 370<br>
					<input type="checkbox" /> HRK 370 - HRK 1100<br>
					<input type="checkbox" /> HRK 1100 - HRK 1400<br>	
                    <input type="checkbox" /> HRK 1100 +			
				</div>
            </div>
            <div class="col-md-2" style="border:1px solid gray;">
				<div>
					<h3>Kategorija:</h3>
                    <input type="checkbox" /><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><br>
					<input type="checkbox" /><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><i class="icon-star-filled"></i><br>
                    <input type="checkbox" /><i class="icon-star-filled"></i><i class="icon-star-filled"></i></i><br>
                    <input type="checkbox" /><i class="icon-star-filled"></i></i><br>
				</div>
                <button>Razvrstaj</button>
			</div>

			<div class="col-md-8" style="border:1px solid gray">
				<h2>Pronađeno:</h2>
                    
                    <div class="container-fluid" style="margin-top:-10px;">
                        <div class="row">
                            <form method="POST" action="rezervation.php">
                                <h3>Hotel</h3>
                                <div class="col-md-4" style="background:url(../images/intro.jpg); min-height:200px;"></div>
                                <div class="col-md-4">Opis:<br>Dvokrevetna<br>Jednokrevetna</div>
                                <div class="col-md-4"><input type="submit" value="REZERVIRAJ" /></div>
                            </form>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <h3>Hotel</h3>
                            <div class="col-md-4" style="background:url(../images/intro.jpg); min-height:200px;"></div>
                            <div class="col-md-4">Opis:<br>Dvokrevetna<br>Jednokrevetna</div>
                            <div class="col-md-4"><a href="#">REZERVIRAJ</a></div>
                        </div>
                    </div>
            </div>
			</div>
		</div>
	</div>

    -->

    


	
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
