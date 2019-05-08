<?php 
    include ('header.php'); 
    if((isset($_GET['id']))&& (is_numeric($_GET['id']))){
        $id = $_GET['id'];
    }elseif((isset($_POST['id']) && (is_numeric($_POST['id'])))){
        $id = $_POST['id'];
    }
    else{
        echo "<p>This page has been accessed in error</p>";
        include ('footer.php');
        exit();
    }
    require ('mysqli_connect.php');
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $errors = array();
        if(empty($_POST['first_name'])){
            $errors[] = "You forgot to enter your first name.";
        }
        else{
            $fn = mysqli_real_escape_string($dbc,$_POST['first_name']);
        }
        if(empty($_POST['last_name'])){
            $errors[] = "You forgot to enter your last name.";
        }
        else{
            $ln = mysqli_real_escape_string($dbc,$_POST['last_name']);
        }
        if(empty($_POST['email'])){
            $errors[] = "You forgot to enter your email.";
        }
        else{
            $e = mysqli_real_escape_string($dbc,$_POST['email']);
        }
        if(empty($_POST['password'])){
            $errors[] = "You forgot to enter your password.";
        }
        else{
            $pass = mysqli_real_escape_string($dbc,$_POST['password']);
        }
        if(empty($errors)){
            $query = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', password='".SHA1($pass)."' WHERE user_id='$id' LIMIT 1";
            $run = mysqli_query($dbc,$query);
            if(mysqli_affected_rows($dbc)==1){
                echo '<p>The user has been edited!</p>';
            }
            else{
                echo '<p> Something went wrong! Please try again.';
            }
        }else{
            echo "<h2>Error!</h2>";
            foreach($errors as $error){
                echo "-$error<br>";
            }
            echo "<p>Please try again!</p>";
        }
    }
    $query = "SELECT first_name,last_name,email,password FROM users WHERE user_id=$id";
    $run = mysqli_query($dbc,$query);
    if (mysqli_num_rows($run)==1){
        $row = mysqli_fetch_array($run, MYSQLI_NUM);
        echo "<form action='edit.php' method='post'>
            <p>First Name <input type='text' name='first_name' value= '{$row[0]}'></p>
            <p>Last Name <input type='text' name='last_name' value= '{$row[1]}'></p>
            <p>Email <input type='text' name='email' value= '{$row[2]}'></p>
            <p>Password <input type='password' name='password' value= '{$row[3]}'></p>
            <input type = 'submit' name='submit' value = 'Update!'>
            <input type = 'hidden' name = 'id' value='$id'> 
            </form>";
    }else{
        echo "<p>Error! There is something wrong! </p>";
    }
    include ('footer.php');
?>