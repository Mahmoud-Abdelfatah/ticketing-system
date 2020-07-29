<?php

session_start();
if ($_SESSION["user"] == "1") {

    header('location:../view/dashboard.php');

}
else
{
	header('location:../index.php');
}
?>