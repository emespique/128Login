<?php 
session_start();
    include("connection.php");
    include("functions.php");
    $errors = array();

    if($_SERVER['REQUEST_METHOD'] == "POST")        #checks if user typed in values for username and password
    {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            $query = "select * from users where user_name='$user_name' limit 1";
            $result = mysqli_query($con, $query);
            if($result) {
                if($result && mysqli_num_rows($result)>0)  {     #checks if user already exists
                    $errors['existing_user'] = "Username already exists";
                }
                else {
                    $user_id = random_num(20);
                    $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";      #adds input to database when condition holds true

                    mysqli_query($con,$query);

                    header("Location: login.php");                  #redirects user to log in page after signing up
                    die;
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
    <title> Sign Up </title>
    <link rel="stylesheet" href="design.css">
</head>

<body id="grad"> 
    <div id="box"> 
        <form method="post">

            <div id="title"> Sign Up </div> <br>

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

            <p class="letter"> Enter username </p>
            <input id="text" type="text" name="user_name"> <br>

            <p class="letter"> Enter password </p>
            <input id="text" type="password" name="password"> <br><br><br><br>

            <input id="button" type="submit" value="Sign Up"> <br><br><br><br>

            <p class="letter" id="alt"> Already have an account? <a href="login.php"> Log In </a> </p>
        </form>
    </div>
</body>

</html>
