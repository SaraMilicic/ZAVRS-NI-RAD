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
                    <a href="index.php">BookCroatia</a>
                </div>
                <div class="col-md-6">
                    <nav class="navigation">
                        <ul>
                            <?php 
                                if(isset($_SESSION["username"])) {
                                    echo "Dobrodošli, " . $_SESSION['username'];
                                    echo 
                                    '<li><a href="#">Admin stranica</a></li>
                                    <li><a href="logout.php">Odjava</a>';

                                }
                                else {
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

    <!-- Login form - visible on click for button "Prijava"-->
    <section class="fluid-container" >
        <div class="col-md-4 col-md-offset-8 col-xs-12" id="login_form" style="display:none;" style="background-color:transparent">
            <div class="intro-tekst">
                <i class="icon-cancel-circled2 cancel-icon" onclick="hide('login_form')" style="float:right;"></i>
                <form class="form-signin" role="form" method="post">
                    <h3>Prijava</h3><br>
                    <input type="text" class="form-control" name="username" placeholder="username" required autofocus></br>
                    <input type="password" class="form-control" name="password" placeholder="password" required><br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12"><h1>Uredi</h1>
            </div>
    <!-- style="display:none;" -->
            <div class="col-md-12">
                <h2 onclick="show('state')">Država</h2>
                <div id="state" >
                    blalablal
                    <?php
                        require_once 'idiorm.php';
                        ORM::configure('mysql:host=localhost:8889;dbname=Booking;charset=utf8');
                        ORM::configure('username','root');
                        ORM::configure('password','root');

                        $results = ORM::for_table('state')->find_many();
                        foreach ($results as $result) {
                            echo $result->country_code . ' ' . $result->name;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>


 <div style="margin:200px;"></div>

  
	
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
