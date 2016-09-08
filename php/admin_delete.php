<?php
	session_start();
	ob_start();
	require_once 'db_conn.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">  
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../fontello-21cce32f/css/fontello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
			    			    
			    #$id = $_SESSION['id'];
				#$state = ORM::for_table('state')->where('state.id', $id)->find_one();

				if(isset($_GET['id'])) {
					$state = ORM::for_table('state')->where('state.id', $_GET['id'])->find_one();
					if($state->is_active == 1) {
				        $state->is_active=0;
				        $state->save();
				        echo 'Redak je uspješno deaktiviran.<br>';                                
			    	}

				    else if($state->is_active == 0) {
				        $state->is_active=1;
				        $state->save();
				        echo 'Redak je uspješno aktiviran.<br>';  
				                                 
				    }   
				}
				echo '<a href="admin.php">Povratak na administratorsku stranicu</a>';
			    
				?>
            </div>
        </div>
    </div>

</body>
</html>