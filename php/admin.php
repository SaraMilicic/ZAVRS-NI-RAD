<?php
    session_start();
    require_once 'db_conn.php';
    // ob_start();
    // if(isset($_SESSION["username"]) && isset($_SESSION["role"]) && $_SESSION["role"] == 'base_user') {
    //     header('Location: index.php');
    // }
    // if(!isset($_SESSION["username"])) {
    //     header('Location: index.php');
    // }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../fontello-72ff7850/css/fontello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- DataTable --> 
    <script type="text/javascript" src="../jquery-3.1.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script>
        $(document).ready(function() {
            $('#state_table').DataTable();
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('#city_table').DataTable();
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('#hotel_table').DataTable();
        } );
    </script>
    
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="row header-top">
                <div class="col-md-6">
                    <a href="index.php" class="logo">BookCroatia</a>
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

    <div class="container">
        <div class="row">
            <div class="col-md-12"><h1>Uredi</h1></div>
        </div>
        
        <!-- State row -->
        <div class="row">

            <div class="col-md-12">
                <h2 >Država</h2>
            <div>
            
            <!-- List of all states -->
            <div class="col-md-12" onclick="toggle_visibility('state')">
                <h3 style="background:silver;">Ispis i brisanje:<i class="icon-right-open-big"></i></h3>
            </div>
            
            <div class="col-md-12 " id="state" style="display:none;">
                <table id="state_table" class="display" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pozivni broj</th>
                            <th>Naziv</th>
                            <th>Aktivan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $states = ORM::for_table('state')->find_many();
                            foreach ($states as $state) {
                                echo 
                                '<tr>'.'<form class="form" role="form" method="POST" action="admin_delete.php?id_state='.$state->id.'">'.
                                    '<th>'.$state->country_code.'</th>'.
                                    '<th>'.$state->name.'</th>'.
                                    '<th>'.$state->is_active.'</th>'.
                                    '<th><input class="btn btn-info" type="submit" name="deactivate" value="Deaktiviraj/Aktiviraj" ></th>'.
                                '</form>'.'</tr>';      
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Add new state -->
            <div class="col-md-12">
                <h3 style="background:silver;" onclick="toggle_visibility('state_insert')">Dodavanje:<i class="icon-right-open-big"></i></h3>
            </div>

            <div class="col-md-12" id="state_insert" style="display:none;">
                <form class="form-inline" role="form" method="POST" action="admin_insert.php">
                    Pozivni broj: <input type="text" class="form-control" name="country_code" required="required"/><br><br>
                    Ime: <input type="text" class="form-control" name="name" required="required"/><br><br>
                    <input class="btn btn-info" type="submit" value="Dodaj">
                </form>
            </div>      
        </div>

        <!-- City row -->
        <div class="row">
            <div class="col-md-12">
                <h2>Grad</h2>
            <div>

            <!-- List of all cities -->
            <div class="col-md-12" onclick="toggle_visibility('city')">
                <h3 style="background:silver;">Ispis i brisanje:<i class="icon-right-open-big"></i></h3>
            </div>

            <div class="col-md-12" id="city" style="display:none;">
                <table id="city_table" class="display" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Poštanski broj</th>
                            <th>Opis</th>
                            <th>Slika</th>
                            <th>ID države</th>
                            <th>Aktivan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $cities = ORM::for_table('city')->find_many();
                            foreach ($cities as $city) {
                                echo '<tr>'.'<form class="form" role="form" method="POST" action="admin_delete.php?postal_code='.$city->postal_code.'">'.
                                    '<th>'.$city->name.'</th>'.
                                    '<th>'.$city->postal_code.'</th>'. 
                                    '<th>'.$city->about.'</th>'.
                                    '<th>'.$city->image.'</th>'.
                                    '<th>'.$city->id_state.'</th>'.
                                    '<th>'.$city->is_active.'</th>'.
                                    '<th><input class="btn btn-info" type="submit" name="deactivate" value="Deaktiviraj/Aktiviraj" ></th>'.
                                '</form>'.'</tr>';                             
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="col-md-12">
                <h3 style="background:silver;" onclick="toggle_visibility('city_insert')">Dodavanje:<i class="icon-right-open-big"></i></h3>
            </div>

            <div class="col-md-4" id="city_insert" style="display:none;">
                <form class="form-inline" role="form" method="POST" action="admin_insert.php">
                    Poštanski broj: <input type="text" class="form-control" required="required" name="postal_code"/><br><br>
                    Ime: <input type="text" class="form-control" required="required" name="name"/><br><br>
                    Opis: <input type="text" class="form-control" required="required" name="about"/><br><br>
                    Slika: <input type="text" class="form-control" required="required" name="image"/><br><br>
                    Id države: <input type="text" class="form-control" name="id_state"/><br><br>
                    <input class="btn btn-info" type="submit" value="Dodaj">
                </form>
            </div>
        </div>

        
        <!-- Hotel row -->
        <div class="row">
            <div class="col-md-12">
                <h2>Hotel</h2>
            <div>

            <!-- List of all hotels -->
            <div class="col-md-12" onclick="toggle_visibility('hotel')">
                <h3 style="background:silver;">Ispis i brisanje:<i class="icon-right-open-big"></i></h3>
            </div>

            <div class="col-md-12" id="hotel" style="display:none;">
                <table id="hotel_table" class="display" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Opis</th>
                            <th>Kategorija</th>
                            <th>Adresa</th>
                            <th>Slika</th>
                            <th>Poštanski broj</th>
                            <th>Aktivan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $hotels = ORM::for_table('hotel')->find_many();
                            foreach ($hotels as $hotel) {
                                echo '<tr>'.'<form class="form" role="form" method="POST" action="admin_delete.php?id_hotel='.$hotel->id.'">'.
                                    '<th>'.$hotel->name.'</th>'.
                                    '<th>'.$hotel->about.'</th>'. 
                                    '<th>'.$hotel->category.'</th>'.
                                    '<th>'.$hotel->address.'</th>'.
                                    '<th>'.$hotel->image.'</th>'.
                                    '<th>'.$hotel->postal_code.'</th>'.
                                    '<th>'.$hotel->is_active.'</th>'.
                                    '<th><input class="btn btn-info" type="submit" name="deactivate" value="Deaktiviraj/Aktiviraj" ></th>'.
                                '</tr>';                             
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <h3 style="background:silver;" onclick="toggle_visibility('hotel_insert')">Dodavanje:<i class="icon-right-open-big"></i></h3>
            </div>

           <div></div>

            

            <div class="col-md-4"id="hotel_insert" style="display:none;">
                <form class="form-inline" role="form" method="POST" action="admin_insert.php">
                    Naziv: <input type="text" class="form-control" required="required" name="name"/><br><br>
                    Opis: <input type="text" class="form-control" required="required" name="about"/><br><br>
                    Kategorija: <input type="text" class="form-control" required="required" name="category"/><br><br>
                    Adresa: <input type="text" class="form-control" required="required" name="address"/><br><br>
                    Slika: <input type="text" class="form-control" required="required" name="image"/><br><br>
                    Poštanski broj: <input type="text" class="form-control" required="required" name="postal_code"/><br><br>

                    <input class="btn btn-info" type="submit" value="Dodaj">
                </form>
            </div>

        </div>





    </div>


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