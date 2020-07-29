<?php

function conncection($host,$username,$password,$db)

{
	$conn = new mysqli($host,$username,$password,$db);

   
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
     // echo "Connected successfully";
      return $conn;
}


?>