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
    <section class="fluid-container intro">
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
    <section class="fluid-container intro" >
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
                    <input type="submit" class="btn btn-primary" id="search" value="Pretraga" name="submit" style="width:100%;">
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid" style="margin-top:60px;">
        <div class="row">
            <div class="col-md-12">
                <h2 style="margin-bottom:40px;">Otkrijte naše hotele</h2>
            </div>
            <?php
                require_once 'idiorm.php';
                require_once 'db_conn.php';

                $cities = ORM::for_table('city')->where('city.is_active',1)->find_many();
                foreach($cities as $city) {                 
                    echo '<div class="col-md-3" style="margin-bottom:60px;">
                            <img src="../images/'.$city->image.'" class="city-image"/>
                            <h3><a href="hotels-by-city.php?city-name='.$city->name.'">'.$city->name.'<i class="icon-right-open-big"></i></a></h3>
                        </div>'; 
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