                            <?php
                            if(count($_POST)>0) {
                                require_once 'idiorm.php';
                                require_once 'db_conn.php';

                                if(isset($_POST['username']) && isset($_POST['username'])) {
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                   
                                    $result = ORM::for_table('user')
                                    ->select_many(array('username' => 'user.username', 'password' => 'user.password',
                                    'role_name' => 'role.name'))->
                                    join('role', array('user.id_role','=','role.id'))
                                    ->where(array('username' => $username,'password' => $password))
                                    ->find_one();

                                    if($result != null) {
                                        $_SESSION["username"] = $result->username;
                                        $_SESSION["password"] = $result->password;
                                        $_SESSION["role"] = $result->role_name;

                                    } else {
                                        echo "Pogreško korisničko ime ili lozinka";
                                    }
                                }
                                
                            }
                            if (isset($_SESSION["username"]) && isset($_SESSION["role"]) && $_SESSION["role"] == 'admin_user') {
                                
                                echo "Vaša uloga na sustavu: " . $_SESSION["role"];
                                echo '<li><a href="admin.php">Admin stranica</a></li>';
                                echo '<li><a href="logout.php">Odjava</a>';
                                
                            }
                            else if(isset($_SESSION["username"]) && isset($_SESSION["role"]) && $_SESSION["role"] == 'base_user') {
                            echo "Dobrodošli, " . $_SESSION['username'];
                            echo "<br>Vaša uloga na sustavu: " . $_SESSION["role"];
                            echo
                                '<li><a href="search.php">Rezervacija</a></li>
                                <li><a href="#">Moja rezervacija</a></li>                            
                                <li><a href="logout.php">Odjava</a>';
                            }
                             
                            else {
                            echo "<li><a href='search.php'>Rezervacija</a></li>
                                <li><a href='#' onclick='showLogin()''>Prijava</a></li>
                                <li><a href='#' onclick='showRegistration()''>Registracija</a></li>
                                ";
                            }
                        ?> 
