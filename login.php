<?php 
session_start();
include("connection.php");
include("functions.php");
$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")        #reads database to see if the username and password typed exist
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        $query = "select * from users where user_name='$user_name' limit 1";

        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result)>0)       #returns user data if at least one result is there
            {
                $user_data=mysqli_fetch_assoc($result);
                if($user_data['password'] === $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
                else {
                    $errors['password'] = "Wrong password";         #username exists but password is wrong
                }
            }
            else {
                $errors['user'] = "Username does not exist";       #username not found
            }
        }

    }
    else if (empty($user_name))
    {
        $errors['empty_user'] = "Username cannot be empty";
    }
    else if (empty($password))
    {
        $errors['empty_password'] = "Password cannot be empty";
    }
    else {
        $errors['valid'] = "Numerical usernames are not allowed";
    }
}
?>

<html>
<head> 
    <title> Log In </title>
    <link rel="stylesheet" href="design.css">
</head>

<body id="grad"> 
    <div id="box"> 
        <form method="post">

            <div id="title"> Log In </div> <br>

            <?php
                if(count($errors) > 0){
                    ?>
                    <div id="text" style="text-align: center">
                        <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                        ?>
                    </div>
                    <?php
                }
            ?>

            <p class="letter"> Username </p>
            <input id="text" type="text" name="user_name"> <br>
            
            <p class="letter"> Password </p>
            <input id="text" type="password" name="password"> <br><br><br><br>

            <input id="button" type="submit" value="Log In"> <br><br><br><br>

            <p class="letter" id="alt"> Don't have an account? <a href="signup.php"> Sign Up </a> </p>
        </form>
    </div>
    
    <div id="text">
    Sample usernames and passwords! <br>
    John: abcde <br>
    Mary: 12345
    </div>
</body>

</html>