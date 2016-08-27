<?php


        /*$query = "SELECT * FROM city join hotel
            ON city.postal_code = hotel.postal_code join room
            ON hotel.id = room.id_hotel left join reservation
            where (room.id not in(select id_room from reservation))
            or
            (room.id in (select id_room from reservation) 
            and !('datum dolaska') >= date_arrival and ('datum odlaska') <= date_departure)";*/

        $city_name = $_POST['city-name'];
        $date_arrival = $_POST['date-arrival'];
        $date_departure = $_POST['date-departure'];
        //$room_type = $_POST['room-type']     . ' ' . $room_type;
        $room_type="Dvokrevetna";
        echo $city_name . ' ' . $date_arrival . ' ' . $date_departure ;

        /*$dbc = mysqli_connect('localhost:8889', 'root', 'root', 'booking') or die('Error!');
        mysqli_set_charset($dbc, 'utf8');

        $query = "SELECT * FROM city join hotel
            ON city.postal_code = hotel.postal_code join room
            ON hotel.id = room.id_hotel left join reservation
            where ((room.id not in(select id_room from reservation))
            or (room.id in (select reservation.id_room from reservation) and ('2016-08-01' >= reservation.date_arrival and '2016-08-03 <= reservation.date_departure)))
            and city.name = 'Zagreb' 
            and room.type ='Jednokrevetna' ";

         
        $result = mysqli_query($dbc, $query);

        while($row = mysql_fetch_array($result)){
        echo $row['hotel.name'];
        echo "<br />";
        }*/

        require_once 'idiorm.php';
        ORM::configure('mysql:host=localhost:8889;dbname=Booking;charset=utf8');
        ORM::configure('username','root');
        ORM::configure('password','root');

        /*$hotels = ORM::for_table('hotel')
            ->select('hotel.*')
            ->join('city', array('hotel.postal_code', '=', 'city.postal_code'))
            ->where_equal('city.name', 'Zagreb')
            ->find_many();*/

        /*raw_query('SELECT p.* FROM person p JOIN role r ON p.role_id = r.id WHERE r.name = :role', 
        array('role' => 'janitor'))->find_many();  */  

        $hotels = ORM::for_table('hotel')->raw_query('SELECT h.* FROM hotel h
            join city c on h.postal_code = c.postal_code
            join room r on h.id = r.id_hotel WHERE c.name = :name', array('name' => 'Zagreb'))->find_many();

        
        foreach($hotels as $hotel):

            echo '<br><br>'.
                $hotel->name;
                

        endforeach;


        /*$reservations = ORM::for_table('reservation')->raw_query('SELECT rsv.* FROM reservation rsv
            where (:date_departure <= rsv.date_arrival and :date_departure <= rsv.date) or 
            (:date_departure >= rsv.date_arrival and :date_departure >= rsv.date)', 
            array('date_departure' => $date_departure, 'date_departure' => $date_departure))->find_many();*/
        
        /* Koliko rezervacija postoji za traženi tip sobe u odabranom gradu*/
        $number_of_reservation_for_selected_room_type = count(ORM::for_table('reservation')->raw_query('SELECT rsv.* from 
            reservation rsv
            join room r on rsv.id_room = r.id
            where r.type= :type', array('type' => $room_type))->find_many());
        echo $number_of_reservation_for_selected_room_type;

        /* Ako za traženi tip sobe ne postoji niti jedna rezervacija, prikaži sve hotele sa traženim tipom soba*/
        if($number_of_reservation_for_selected_room_type == 0) {
            $results = ORM::for_table('hotel')->raw_query('SELECT h.* FROM hotel h
            join city c on h.postal_code = c.postal_code
            join room r on h.id = r.id_hotel

            WHERE c.name = :name and r.type = :type', 
            array('name' => $city_name, 'type' => $room_type))->find_many();

        
        
            foreach($results as $result):

                echo '<br><br>'.
                    $result->name;
                echo $result->about;

                echo $room_type;


                    

            endforeach;
        }


        /* Ako za traženi tip sobe u odabranom gradu postoji rezervacija, 
        pronađi sve sobe i hotele koje nemaju rezervaciju u tražeom periodu*/
        else {

            $results = ORM::for_table('hotel')->raw_query('SELECT h.* from hotel h 
            join room r on h.id = r.id_hotel
            join reservation rsv on rsv.id_room = r.id
            where r.type= :type
            and !((:date_arrival <= rsv.date_departure) and (:date_departure >= rsv.date_arrival))',
            array('type' => $room_type, 'date_arrival' => $date_arrival, 'date_departure' => $date_departure))->find_many();
            
            $number_of_hotels = count(ORM::for_table('hotel')->raw_query('SELECT h.* from hotel h 
            join room r on h.id = r.id_hotel
            join reservation rsv on rsv.id_room = r.id
            where r.type= :type
            and !((:date_arrival <= rsv.date_departure) and (:date_departure >= rsv.date_arrival))',
            array('type' => $room_type, 'date_arrival' => $date_arrival, 'date_departure' => $date_departure))->find_many()
            );

            if ($number_of_hotels == 0) {
                echo "Trenutno nema slobodnih soba na taj datum";
            }

            /*$results = ORM::for_table('reservation')->raw_query('SELECT rsv.* from 
            reservation rsv
            join room r on rsv.id_room = r.id
            where r.type= :type
            and !((:date_arrival <= rsv.date_departure) and (:date_departure >= rsv.date_arrival))',
            array('type' => $room_type, 'date_arrival' => $date_arrival, 'date_departure' => $date_departure))->find_many();*/
            

            //echo 'Nema';

        foreach($results as $result):

                echo '<br><br>'.
                    $result->name;
                echo $result->about;

                echo $room_type;
                

            endforeach;

/*(StartA <= EndB)  and  (EndA >= StartB)
zadani_arrival <= date_departure


(StartDate1 <= EndDate2) and (StartDate2 <= EndDate1)*/
        }
        

    
        /*
        upit koji dobro vraca hotele, ali ne gleda rezervacije
        $results = ORM::for_table('hotel')->raw_query('SELECT h.* FROM hotel h
            join city c on h.postal_code = c.postal_code
            join room r on h.id = r.id_hotel

            WHERE c.name = :name and r.type = :type', 
            array('name' => $city_name, 'type' => $room_type))->find_many();

        
        
        foreach($results as $result):

            echo '<br><br>'.
                $result->name;
            echo $result->about;

            echo $room_type;
                

        endforeach;*/

    ?>