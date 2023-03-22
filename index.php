<?php 
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);     #if user is not logged in they will be redirected else this line will contain the user data

?>

<html>
<head> 
    <title> Index </title>
    <link rel="stylesheet" href="design.css">
</head>
<body id="grad" style="text-align:center; font-family:Helvetica;"> 
    <h1> Welcome to the index page! </h1> <br>
    <p> Hello, user <?php echo $user_data['user_name']; ?>! </p> <br> <br>
    <a href="logout.php"> Log Out </a>
</body>
</html>
    

