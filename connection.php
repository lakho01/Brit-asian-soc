<?php

// $dbhost = "localhost";
// $dbuser = "root";
// $dbpass = "";
// $dbname = "test";

// $dbhost = "http://46.101.58.136";
// $dbuser = "admin";
// $dbpass = "0a34508fec685026cf4a385d656ffcf8d41c0641ad073538";
// $dbname = "test";

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "0a34508fec685026cf4a385d656ffcf8d41c0641ad073538";
$dbname = "test";




if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}



