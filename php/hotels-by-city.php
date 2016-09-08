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
        <div class="container-fluid hotels-by-city-intro">
            <div class="row header-top">
                <div class="col-md-6">
                    <a href="index.php" class="logo">BookCroatia</a>
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



   <div class="container" style="margin-top:40px;">
        <form class="row form-inline" role="form" method="POST" action="hotel.php">
            <!-- za row:
             style="margin-bottom:60px; margin-left:60px; margin-right:60px;"
            -->

            <?php
            require_once 'idiorm.php';
            require_once 'db_conn.php';

            if(isset($_GET['city-name'])) {
                $_SESSION['link']=$_GET['city-name'];
                $city_name = $_GET['city-name'];

                $city = ORM::for_table('city')->where('city.name', $city_name)->find_one();

                $number_of_cities = count(ORM::for_table('city')->where('city.name', $_GET['city-name'])->find_one());

                if ($number_of_cities == 0) {
                    echo "Za traženi grad trenutno nema hotela.";

                }
                else {
                    echo '<div class="form-group col-md-12">
                        <h2 style="margin-bottom:20px;">Otkrijte naše hotele:</h2>
                        <h2 style="margin-bottom:20px;">'.$city->name.'</h2>
                        <p>'.$city->about.'</p>
                        
                    </div>';

                    $hotels = ORM::for_table('hotel')
                    ->select_many(array('hotel_name'=>'hotel.name','city_name'=>'city.name'))
                    ->join('city', array('hotel.postal_code', '=', 'city.postal_code'))
                    ->where(array('city.name' => $city_name))
                    ->find_many();

                    foreach($hotels as $hotel) {
                    echo '<div class="col-md-4">
                            <h3><a href="hotel.php?hotel-name='.$hotel->hotel_name.'">'.$hotel->hotel_name.'<i class="icon-right-open-big"></i></a></h3>
                            <img src="../images/zagreb1.jpg" class="city-image"/>
                            <a class="btn btn-primary" href="hotel.php" style="float:right";>Više</a>                      
                        </div>';
                    }

                }
            } else {
                echo '<div class="col-md-12">Za traženi grad trenutno nema hotela.</div>    ';
            }
            
            ?>
  
        </form>
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
</body>
</html>