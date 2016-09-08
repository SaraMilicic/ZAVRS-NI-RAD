<?php
	require_once 'idiorm.php';
    ORM::configure('mysql:host=localhost:8889;dbname=Booking;charset=utf8');
    ORM::configure('username','root');
    ORM::configure('password','root');
    ORM::configure('id_column_overrides', array('city' => 'postal_code',));
?>