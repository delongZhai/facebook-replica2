<?php
    include('header.php');
    require('mysqli_connect.php');
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errors=array();

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
            $query = "INSERT INTO user_info (education,degree,current_city,hometown) VALUES('$inst','$degree','$city','$town')";
    
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