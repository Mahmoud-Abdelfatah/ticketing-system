<?php
include('connection.php');
session_start();

$conn = conncection('sql301.byethost.com','b17_22912813','mhmoed123','b17_22912813_login_db');




         $user_id = $_SESSION['row']['id'];
    if ($user_id) {

    	$query = @unserialize (file_get_contents('http://ip-api.com/php/'));
        $user_id = $_SESSION['row']['id'];
        $action = 'Logout';
        $action_time = date('Y-m-d H:i:s');
        $city = $query['city'];
        $lat = $_SESSION["Latitude"];
        $lon = $_SESSION["Longitude"];

    	$sql = "insert into user_details (user_id,action,action_time,city,lat,lon) values('$user_id','$action','$action_time','$city','$lat','$lon')";
        $result = mysqli_query($conn,$sql);
    	
    }



session_unset();
session_destroy();

header('location:index.php')

?>