<?php
    session_start();
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
                    <a href="index.html">BookCroatia</a>
                </div>
                <div class="col-md-6">
                    <nav class="navigation">
                        <ul>
                        <?php
                            if(count($_POST)>0) {
                                require_once 'idiorm.php';
                                ORM::configure('mysql:host=localhost:8889;dbname=Booking;charset=utf8');
                                ORM::configure('username','root');
                                ORM::configure('password','root');

                                $username = $_POST['username'];
                                $password = $_POST['password'];
                               
                                $result = ORM::for_table('user')
                                            ->where(array(
                                            'username' => $username,
                                            'password' => $password
                                            ))
                                            ->find_one();


                            
                            if($result != null) {
                                $_SESSION["username"] = $result->username;
                                $_SESSION["password"] = $result->password;
                                $_SESSION['user'] = $result->id;
                            } else {
                            echo "Invalid Username or Password!";
                            }
                            }
                            if(isset($_SESSION["username"])) {
                            echo "Dobrodošli, " . $_SESSION['username'];
                            echo '<li><a href="search.php">Rezervacija</a></li>
                            
                            <li><a href="#">Moja rezervacija</a></li>
                            
                            <li><a href="logout.php">Odjava</a>';

                            }
                            else {
                            
                            #echo '<li><a href="search.php">Rezervacija</a></li>
                            #<li><a href="#" onclick="show(\"login_form\")">Prijava</a></li>
                            #<li><a href="#">Registracija</a></li>
                            #';
                            
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

    

  <section class="fluid-container intro" >
        <div class="col-md-4 col-md-offset-8 col-xs-12" id="login_form" style="display:none;" style="background-color:transparent">
            <div class="intro-tekst">
            <form class = "form-signin" role="form" 
             method = "post">
            <h3>Prijava</h3><br>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required><br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>

         </form>
     </div>
        </div>
    </section>
    <!-- 
    btn btn-primary

    action = "
    <?php #echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" -->
    <!-- <div class="fluid-container" id="login_form" style="display:none;">
        <div class="col-md-12">
            <form class = "form-signin" role="form" 
             method = "post">
            
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username = tutorialspoint" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password = 1234" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
        </div>
    </div> -->

    

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

    
    
   <div class="container-fluid" style="margin-top:40px;">
        <div class="row">
            <!-- za row:
             style="margin-bottom:60px; margin-left:60px; margin-right:60px;"
            -->
        	<div class="col-md-12">
        		<h2 style="margin-bottom:20px;">Otkrijte naše hotele</h2>
        	</div>
            <div class="col-md-3">
                <img src="../images/zagreb1.jpg" class="city-image"/>
                <h3><a href="hotels-by-city.php">Zagreb<i class="icon-right-open-big"></i></a></h3>
                
            </div>
            <div class="col-md-3">
                <img src="../images/dubrovnik.jpg" class="city-image"/>
                <h3><a href="#">Dubrovnik<i class="icon-right-open-big"></i></a></h3>
            </div>
            <div class="col-md-3">
                <img src="../images/rovinj1.jpg" class="city-image"/>
                <h3><a href="#">Rovinj<i class="icon-right-open-big"></i></a></h3>
            </div>
            <div class="col-md-3">
                <img src="../images/osijek.jpg" class="city-image"/>
                <h3><a href="#">Osijek<i class="icon-right-open-big"></i></a></h3>
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