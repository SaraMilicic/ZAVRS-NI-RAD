<?php
                            if(count($_POST)>0) {
                                require_once 'idiorm.php';
                                ORM::configure('mysql:host=localhost:8889;dbname=Booking;charset=utf8');
                                ORM::configure('username','root');
                                ORM::configure('password','root');

                                $username = $_POST['username'];
                                $password = $_POST['password'];
                               
                                $result = ORM::for_table('user')
                                ->select_many(array('username' => 'user.username', 'password' => 'user.password',
                                'role_name' => 'role.name'))->
                                join('role', array('user.id_role','=','role.id'))
                                ->where(array('username' => $username,'password' => $password))
                                ->find_one();

                                /*$result = ORM::for_table('user')
                                            ->where(array(
                                            'username' => $username,
                                            'password' => $password
                                            ))
                                            ->find_one();*/

                                if($result != null) {
                                    $_SESSION["username"] = $result->username;
                                    $_SESSION["password"] = $result->password;
                                    $_SESSION["role"] = $result->role_name;

                                } else {
                                    echo "Invalid Username or Password!";
                                }
                            }
                            if (isset($_SESSION["username"]) && isset($_SESSION["role"]) && $_SESSION["role"] == 'admin_user') {
                                echo '<h1><a href="admin.php"></a></h1>';
                                echo '<li><a href="logout.php">Odjava</a>';
                                
                            }
                            else if(isset($_SESSION["username"]) && isset($_SESSION["role"]) && $_SESSION["role"] == 'base_user') {
                            echo "Dobrodošli, " . $_SESSION['username'];
                            echo "<br>Vaša uloga na sustavu: " . $result->role_name;
                            echo
                                '<li><a href="search.php">Rezervacija</a></li>
                                <li><a href="#">Moja rezervacija</a></li>                            
                                <li><a href="logout.php">Odjava</a>';
                            }
                             
                            else {
                            echo "<li><a href='search.php'>Rezervacija</a></li>
                                <li><a href='#' onclick='show(\"login_form\")''>Prijava</a></li>
                                <li><a href='#'>Registracija</a></li>
                                ";
                            }
                        ?> 