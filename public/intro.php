<?php
    session_start();
    include('header.php');
    require('mysqli_connect.php');
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errors=array();
        $userID =$_SESSION['user_id'][0];

        if(empty($_POST['Institution'])){
            $errors[]="Please enter the institution you attended.";
        }else{
            $inst = $_POST['Institution'];
        }

        if(empty($_POST['Degree'])){
            $errors[] = "Please enter the degree you received.";
        }else{
            $degree = $_POST['Degree'];
        }

        if(empty($_POST['City'])){
            $errors[] = "Please enter your current city.";
        }else{
            $city = $_POST['City'];
        }

        if(empty($_POST['Hometown'])){
            $errors[] = "Please enter your hometown.";
        }else{
            $town = $_POST['Hometown'];
        }

        if(empty($errors)){
            $query = "UPDATE users SET education='$inst', degree='$degree', current_city='$city', hometown='$town' WHERE user_id='$userID'";
    
            $run = mysqli_query($dbc,$query);
    		if($run){
                echo "<h1>Thank you! Your information has been registered with our database  </h1>";
            }else{
                echo "<h1>System Error</h1> You could not be registered due to an error.";
                echo "<p>".mysqli_error($dbc)."</p>";
            }
        }else{
            echo "<h1>Errors!</h1>";
            foreach($errors as $error){
                echo " - $error <br>";
            }
            echo "Please try again!";
        }
    
        mysqli_close($dbc);
    }
    include('footer.php');
?>