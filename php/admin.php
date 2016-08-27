<?php
    session_start();
    require_once 'db_conn.php';
    ob_start();
    if(isset($_SESSION["username"]) && isset($_SESSION["role"]) && $_SESSION["role"] == 'base_user') {
        header('Location: index.php');
    }
    if(!isset($_SESSION["username"])) {
        header('Location: index.php');
    }
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

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

  
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
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
        </div>
    <!-- style="display:none;" -->
        
        <!-- States -->
        <div class="row">
            <div class="col-md-12" >
                <h2 >Država</h2>
            <div>

            <!-- List of all states -->
            <div class="col-md-12" onclick="toggle_visibility('state')">
                <h3 style="background:silver;">Ispis svih država:<i class="icon-right-open-big"></i></h3>
            </div>
            <div class="col-md-6 " id="state" style="display:none;">
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Pozivni broj</th>
                            <th>Naziv</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                                $states = ORM::for_table('state')->find_many();
                                foreach ($states as $state) {
                                    echo '<tr>'.
                                        '<th>'.$state->country_code.'</th><br>'.
                                        '<th>'.$state->name.'</th><br>'. 
                                    '</tr>';                             
                                }
                            ?>
                        </tbody>
                </table>
            </div>
            <div class="col-md-6"></div>
        
            <!-- Add new state -->
            <div class="col-md-12">
                <h3>Dodaj</h3>
                <form class="form-inline" role="form" method="POST" action="">
                    Pozivni broj: <input type="text" /><br><br>
                    Ime: <input type="text" />
                    <input class="btn btn-info" type="submit" value="Dodaj">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Grad</h2>
            <div>
            <!-- List of all cities -->
            <div class="col-md-12" onclick="toggle_visibility('city')">
                <h3 style="background:silver;">Ispis svih gradova:<i class="icon-right-open-big"></i></h3>
            </div>
            <div class="col-md-12" id="city" style="display:none;">
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Poštanski broj</th>
                            <th>Opis</th>
                            <th>Slika</th>
                            <th>ID države</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $cities = ORM::for_table('city')->find_many();
                            foreach ($cities as $city) {
                                echo '<tr>'.
                                    '<th>'.$city->name.'</th><br>'.
                                    '<th>'.$city->postal_code.'</th><br>'. 
                                    '<th>'.$city->about.'</th><br>'.
                                    '<th>'.$city->image.'</th><br>'.
                                    '<th>'.$city->id_state.'</th><br>'.
                                '</tr>';                             
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Add new city -->
            <div class="col-md-12">
                <h3  style="background:silver;">Dodaj</h3>
                <form class="form-inline" role="form" method="POST" action="">
                    Poštanski broj: <input type="text" /><br><br>
                    Ime: <input type="text" required="required"/><br><br>
                    Opis: <input type="text" required="required"/><br><br>
                    Slika: <input type="text" required="required"/><br><br>
                    Id države: <input type="text" />

                    Država:
                    <select class="form-control" id="state-selection" required="required">
                        <?php
                            $states = ORM::for_table('state')->find_many();
                                foreach($states as $state) {
                                    echo '<option value=' . $state->name . '><option/>'                            
                                }
                            ?>
                        </select>
                    </form>
            </div>

            
            <div class="row">
            <div class="col-md-12" onclick="show('hotel')" >
                <h2 style="background:silver;">Hotel<i class="icon-right-open-big"></i></h2>
            <div>

            <div class="col-md-12" id="state" >
               
                    <?php
                        $hotels = ORM::for_table('hotel')->find_many();
                        foreach ($hotels as $hotel) {
                            echo $hotel->name . '<br>'. 
                            $hotel->address . '<br>'. 
                            $hotel->postal_code . '<br>'. 
                            $hotel->category . ' zvjezdica ' . '<br>'. 
                            $hotel->about . '<br>'.
                            $hotel->image . '<br>';
                            
                        }
                    ?>
                    <h3>Dodaj</h3>
                    <form class="form-inline" role="form" method="POST" action="">
                        Pozivni broj: <input type="text" /><br><br>
                        Ime: <input type="text" />
                        <input class="btn btn-info" type="submit" value="Dodaj">

                    </form>
            </div>



            <div class="col-md-12" id="state" >
               
                    <?php
                        $hotels = ORM::for_table('hotel')->find_many();
                        foreach ($hotels as $hotel) {
                            echo $hotel->name . '<br>'. 
                            $hotel->address . '<br>'. 
                            $hotel->postal_code . '<br>'. 
                            $hotel->category . ' zvjezdica ' . '<br>'. 
                            $hotel->about . '<br>'.
                            $hotel->image . '<br>';
                            
                        }
                    ?>
                    <h3>Dodaj</h3>
                    <form class="form-inline" role="form" method="POST" action="">
                        Pozivni broj: <input type="text" /><br><br>
                        Ime: <input type="text" />
                        <input class="btn btn-info" type="submit" value="Dodaj">

                    </form>
            </div>



            <div class="col-md-12">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Postal_code</th>
                        <th>Category</th>
                        <th>About</th>
                        <th>Image</th>
                    </tr>
                </thead>
                    <tbody>
                    
                        <?php
                            $hotels = ORM::for_table('hotel')->find_many();
                            foreach ($hotels as $hotel) {
                                echo '<tr>'.
                                '<th>'.$hotel->name.'</th><br>'.
                                '<th>'.$hotel->address.'</th><br>'. 
                                '<th>'.$hotel->postal_code.'</th><br>'. 
                                '<th>'.$hotel->category.'</th><br>'. 
                                '<th>'.$hotel->about.'</th><br>'. 
                                '<th>'.$hotel->image.'</th><br>'.
                                '</tr>';                             
                            }
                        ?>
                    
                    </tbody>
            </table>
        </div>
        </div>





        </div>
    </div>


 <div style="margin:200px;"></div>

  
	
	<!--<footer style="background-color: silver; min-height:100px; margin-top:60px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
                <div class="col-xs-3 col-md-3"></div>
            </div>
        </div>
    </footer> -->

    <script>
        function show(target){
            document.getElementById(target).style.display = 'block';
        }
        function hide(target){
            document.getElementById(target).style.display = 'none';
        }

        function toggle_visibility(id) {
        var e = document.getElementById(id);
        if(e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
        }
    </script>

    
</body>
</html>
