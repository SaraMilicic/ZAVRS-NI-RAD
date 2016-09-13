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
                                 if(isset($_SESSION["username"])) {
                                     echo "Dobrodošli, " . $_SESSION['username'];
                                     echo '<li><a href="search.php">Rezervacija</a></li>
                                     <li><a href="#">Moja rezervacija</a></li>
                                     <li><a href="logout.php">Odjava</a>';
                                 }
                                 else {
                                     echo "<li><a href='search.php'>Rezervacija</a></li>
                                     <li><a href='#' onclick='show(\"login_form\")''>Prijava</a></li>
                                     <li><a href='#' onclick='show(\"registration_form\")''>Registracija</a></li>
                                     ";
                                 }
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

            
                    
                    echo '<div class="col-md-4"><a href="reservation_step_one.php?room_id=2"><h1 style="color:black;">1. Odabir sobe</h1></a></div>
                <div class="col-md-4"><a href="reservation_step_two.php" class="not-active"><h1>2. Osobni podaci</h1></a></div>
                <div class="col-md-4"><a href="reservation_step_three.php" class="not-active"><h1>3. Potvrda rezervacije</h1></a></div>';
         

                    echo '<div class="col-md-12">
                        
                        <h4>Hotel Zagreb</h4>
                        <p>Dvokrevetna soba</p>
                        <p>1. kat</p>
                        <p>Datum dolaska: 11-10-2016</p>
                        <p>Datum odlaska: 12-10-2016</p>
                        <p>Cijena noćenja: 1000 kn </p>
                        <a class="btn btn-primary" href="reservation_step_two.php" style="float:right";>Nastavi</a>     
                    </div>';
        

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
