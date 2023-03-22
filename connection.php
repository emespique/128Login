<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "log_in_db";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect!");
}


