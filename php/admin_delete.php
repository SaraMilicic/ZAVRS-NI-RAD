<?php
	session_start();
	ob_start();
	require_once 'db_conn.php';
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

				if(isset($_GET['id_state'])) {
					$state = ORM::for_table('state')->where('state.id', $_GET['id_state'])->find_one();
					if($state->is_active == 1) {
				        $state->is_active=0;
				        $state->save();
				        echo 'Redak je uspješno deaktiviran.<br>';                                
			    	}
				    else if($state->is_active == 0) {
				        $state->is_active=1;
				        $state->save();
				        echo 'Redak je uspješno aktiviran.<br>';                                
				    }   
				}

				if(isset($_GET['postal_code'])) {
					$city = ORM::for_table('city')->where('city.postal_code', $_GET['postal_code'])->find_one();
					if($city->is_active == 1) {
				        $city->is_active=0;
				        $city->save();
				        echo 'Redak je uspješno deaktiviran.<br>';                                
			    	}
				    else if($city->is_active == 0) {
				        $city->is_active=1;
				        $city->save();
				        echo 'Redak je uspješno aktiviran.<br>';                                
				    }   
				}

				if(isset($_GET['id_hotel'])) {
					$hotel = ORM::for_table('hotel')->where('hotel.id', $_GET['id_hotel'])->find_one();
					if($hotel->is_active == 1) {
				        $hotel->is_active=0;
				        $hotel->save();
				        echo 'Redak je uspješno deaktiviran.<br>';                                
			    	}
				    else if($hotel->is_active == 0) {
				        $hotel->is_active=1;
				        $hotel->save();
				        echo 'Redak je uspješno aktiviran.<br>';                                
				    }   
				}

				echo '<a href="admin.php">Povratak na administratorsku stranicu</a>';
			    
				?>
            </div>
        </div>
    </div>

</body>
</html>