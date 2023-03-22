<?php

function check_login($con)              #checks if user is logged in
{
    if(isset($_SESSION['user_id']))     #checks if user_id is set and returns user data
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
    
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result)>0)          
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    header("Location: login.php");          #redirects to login
    die;
}

function random_num($length)        #randomizes user ids given specified length
{
    $text = '';
    if($length<5)
    {
        $length = 5;
    }

    $len = rand(4,$length);         

    for ($i=0; $i<$len; $i++) {
        $text .=rand(0,9);
    }

    return $text;
}