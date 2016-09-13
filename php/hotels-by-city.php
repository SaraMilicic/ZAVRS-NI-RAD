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
            <div class="intro-login-hotel">
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
            <div class="intro-registration-hotel">
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
    
    <img src="../images/zagreb1.jpg" style="margin:0 auto;" class="img-responsive" alt="Responsive image">
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

                $city = ORM::for_table('city')
                ->where(array(
                    'city.name' => $city_name,
                    'city.is_active' => 1))
                ->find_one();

                $number_of_cities = count(ORM::for_table('city')
                    ->where(array(
                        'city.name' => $_GET['city-name'],
                        'city.is_active' => 1))
                    ->find_one());

                if ($number_of_cities == 0) {
                    echo "Za traženi grad trenutno nema hotela.";

                }
                else {
                    echo '<div class="form-group col-md-12">
                            <h2 style="margin-bottom:60px;">Otkrijte naše hotele:</h2>
                            <h2 style="margin-bottom:20px;">'.$city->name.'</h2>
                            <p style="margin-bottom:40px;">'.$city->about.'</p>                        
                        </div>';

                    $hotels = ORM::for_table('hotel')
                    ->select_many(array('hotel_name'=>'hotel.name','city_name'=>'city.name'))
                    ->join('city', array('hotel.postal_code', '=', 'city.postal_code'))
                    ->where(array('city.name' => $city_name, 'hotel.is_active' => 1))
                    ->find_many();

                    foreach($hotels as $hotel) {
                    echo '<div class="col-md-4">
                            <h3><a href="hotel.php?hotel-name='.$hotel->hotel_name.'">'.$hotel->hotel_name.'<i class="icon-right-open-big"></i></a></h3>
                            <img src="../images/zagreb1.jpg" class="city-image"/>
                            <a class="btn btn-primary" href="hotel.php?hotel-name='.$hotel->hotel_name.'" style="float:right";>Više</a>                      
                        </div>';
                    }

                }
            } else {
                echo '<div class="col-md-12">Za traženi grad trenutno nema hotela.</div>';
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