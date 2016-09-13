<?php
    session_start();
    ob_start();
?>
<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<!--link href="../pop_out_form/elements.css" rel="stylesheet"-->
	
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../fontello-72ff7850/css/fontello.css">
    <!--script src="../pop_out_form/my_js.js"></script-->
	<link rel="stylesheet" href="../style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  	<style>
  		.carousel-inner > .item > img,
  		.carousel-inner > .item > a > img {
      	width: 100%;
      	height: 600px;
      	margin: auto;
  		}
  	</style>

</head>

<body>
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
    
	<div class="container-fluid">	
		<div class="row">
			<div class="col-md-12">
				<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="6000" style="width:100%;">
			    <!-- Indicators -->
				    <ol class="carousel-indicators">
				      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				      <li data-target="#myCarousel" data-slide-to="1"></li>
				      <li data-target="#myCarousel" data-slide-to="2"></li>
				      <li data-target="#myCarousel" data-slide-to="3"></li>
				    </ol>

			    <!-- Wrapper for slides -->
				    <div class="carousel-inner" role="listbox">
				      <div class="item active">
				        <img src="../images/hotel1.jpg" alt="Hotel" width="460" height="345">
				      </div>

				      <div class="item">
				        <img src="../images/hotel-dubrovnik.jpg" alt="Hotel" width="460" height="345">
				      </div>
				    
				      <div class="item">
				        <img src="../images/hotel-osijek.jpg" alt="Hotel" width="460" height="345">
				      </div>

				      <div class="item">
				        <img src="../images/hotel-zagreb.jpg" alt="Hotel" width="460" height="345">
				      </div>
				    </div>

			    <!-- Left and right controls -->
				    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				      <span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				      <span class="sr-only">Next</span>
				    </a>
			 	 </div>
			</div>
		</div>
	</div>

	

	<div class="container">	
		<?php
	        require_once 'idiorm.php';
	        require_once 'db_conn.php';

	        if(isset($_GET['hotel-name'])) {
	            $_SESSION['link']=$_GET['hotel-name'];
	            $hotel_name = $_GET['hotel-name'];
	            $hotel = ORM::for_table('hotel')->where('hotel.name', $hotel_name)->find_one();
	            $number_of_hotels = count(ORM::for_table('hotel')->where('hotel.name', $hotel_name)->find_one());

	            if ($number_of_hotels == 0) {
	                echo "Za traženi hotel trenutno nema informacija.";

	            }
	            else {
	                $rooms = ORM::for_table('room')
	                ->select_many(array('room_type'=>'room.type', 'room_price'=>'room.price', 'room_floor'=>'room.floor',
	                	'hotel_name'=>'hotel.name', 'hotel_address'=>'hotel.address', 'hotel_category'=>'hotel.category',
	                	'city_name'=>'city.name', 'hotel_image'=>'hotel.image'))
	                ->join('hotel', array('room.id_hotel', '=', 'hotel.id'))
	                ->join('city', array('hotel.postal_code', '=', 'city.postal_code'))
	                ->where(array('hotel.name' => $hotel_name))
	                ->find_many();

	                echo '<h1>'.$hotel->name.'</h1>';

	                for ($i = 0; $i < $hotel->category; $i++) {
					    echo '<i class="icon-star"></i>';
					}

	                echo '<h3>'.$hotel->address.'</h3>';
	                echo '<h2 style="margin-top:60px;">Popis soba</h2>';

	                foreach($rooms as $room) {
	                $_SESSION['hotel_image'] = $room->hotel_image;
	                echo '<div class="row" style="margin-bottom:100px;">
	                	<div class="col-md-6">
							<img src="../images/'.$room->hotel_image.'" style="width:100%;">
						</div>
						<div class="col-md-6">
							<p>
								<b>Informacije o sobi:</b><br>
								'.$room->room_type.' soba<br>
								'.$room->room_floor.'.kat<br>
								Cijena: <b>'.$room->room_price.'</b> kn
							</p>
						</div>
						</div>';
	                }
	            }
	        } else {
	            echo '<div class="col-md-12">Za traženi hotel trenutno nema informacija.</div>    ';
	        }        
	    ?>		
	</div>
	
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
