<?php
    session_start();
    ob_start();
    /*if(isset($_SESSION["username"]) && isset($_SESSION["role"]) && $_SESSION["role"] == 'admin_user') {
        header('Location: admin.php');
    }
    ob_end_flush();*/
    
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
                    require_once 'db_conn.php';

                    #insert new state
                    if(isset($_POST['country_code']) && isset($_POST['name'])) {
                        $country_code = $_POST['country_code'];
                        $name = $_POST['name'];

                        $state = ORM::for_table('state')->create();
                        $state->country_code = $country_code;
                        $state->name = $name;
                        $state->is_active = 1;

                        $state->save();

                        echo "Uspješno ste unijeli podatke u bazu.<br>";
                    }

                    #insert new city
                    if(isset($_POST['postal_code']) && isset($_POST['name']) && isset($_POST['about']) && isset($_POST['image']) && isset($_POST['id_state'])) {
                        $postal_code = $_POST['postal_code'];
                        $name = $_POST['name'];
                        $about = $_POST['about'];
                        $image = $_POST['image'];
                        $id_state = $_POST['id_state'];

                        $city = ORM::for_table('city')->create();
                        $city->postal_code = $postal_code;
                        $city->name = $name;
                        $city->about = $about;
                        $city->image = $image;
                        $city->id_state = $id_state;
                        $city->is_active = 1;

                        $city->save();

                        echo "Uspješno ste unijeli podatke u bazu.<br>";
                    }

                    #insert new hotel
                    if(isset($_POST['name']) && isset($_POST['about']) && isset($_POST['category']) && isset($_POST['address']) && isset($_POST['image']) && isset($_POST['postal_code'])) {                       
                        $hotel = ORM::for_table('hotel')->create();
                        $hotel->name = $_POST['name'];
                        $hotel->about = $_POST['about'];
                        $hotel->category = $_POST['category'];
                        $hotel->address = $_POST['address'];
                        $hotel->image = $_POST['image'];
                        $hotel->postal_code = $_POST['postal_code'];
                        $hotel->is_active = 1;

                        $hotel->save();

                        echo "Uspješno ste unijeli podatke u bazu.<br>";
                    }

                    echo '<a href="admin.php">Povratak na administratorsku stranicu</a>';                  
                ?>
            </div>
        </div>
    </div>
</body>
</html>