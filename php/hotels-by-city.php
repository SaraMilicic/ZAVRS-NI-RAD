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



   <div class="container-fluid" style="margin-top:40px;">
        <div class="row">
            <!-- za row:
             style="margin-bottom:60px; margin-left:60px; margin-right:60px;"
            -->
            <?php
            require_once 'idiorm.php';
            require_once 'db_conn.php';


            ?>
        	<div class="col-md-12">
                <h2 style="margin-bottom:20px;">Otkrijte naše hotele:</h2>
        		<h2 style="margin-bottom:20px;">Zagreb</h2>
                <p>Grad Zagreb, smješten na zemljopisnom, kulturnom, povijesnom i političkom sjecištu istoka i zapada Europe, glavni grad Hrvatske, spaja kontinentalni i mediteranski duh u osebujnu cjelinu. Zagreb je siguran velegrad otvorenih vrata, burne povijesti i zanimljivih ličnosti, koji srdačno poziva na upoznavanje i ispunjava očekivanja.</p>
        	</div>

            <div class="col-md-4">
                <img src="../images/zagreb1.jpg" class="city-image"/>
                <h3><a href="#">Hotel<i class="icon-right-open-big"></i></a></h3>
            </div>
            <div class="col-md-4">
                <img src="../images/zagreb1.jpg" class="city-image"/>
                <h3><a href="#">Hotel<i class="icon-right-open-big"></i></a></h3> 
            </div>
            <div class="col-md-4">
                <img src="../images/zagreb1.jpg" class="city-image"/>
                <h3><a href="#">Hotel<i class="icon-right-open-big"></i></a></h3>
            </div>
            
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
</body>
</html>