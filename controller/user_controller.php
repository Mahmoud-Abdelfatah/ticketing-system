<?php

include('../connection.php');

 $conn = conncection('localhost','root','','login_db');


//echo  $_SESSION["Latitude"];

if (isset($_POST['submit'])) {
	
	$username = $_POST['username'];
	$password = $_POST['pass'];
	$sql = "select * from users,role_user where username ='$username' and password = '$password' and users.id=role_user.user_id limit 1 ";
    $result = mysqli_query($conn,$sql);
    //session_start();
   $_SESSION['row']=$row = mysqli_fetch_assoc($result);


    if($row>0)
    {
    	$user_id = $_SESSION['row']['id'];
    	$_SESSION["user"] = "1";

        
    	$query = @unserialize (file_get_contents('http://ip-api.com/php/'));
         
        $action = 'Login';
        $action_time = date('Y-m-d H:i:s');
        $city = $query['city'];
        $lat = $_SESSION["Latitude"];
        $lon = $_SESSION["Longitude"];

    	$sql = "insert into user_details (user_id,action,action_time,city,lat,lon) values('$user_id','$action','$action_time','$city','$lat','$lon')";
        $result = mysqli_query($conn,$sql);

    	header('location:../view/dashboard.php');
    }else
    {
    	echo "wrong cradintials";
    }
	
}



?>

