<?php
    session_start();
    include('header.php');
    require('mysqli_connect.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userID =$_SESSION['user_id'][0];
        $errors = array(); //Intialize an array that will store error messages for the user
        
        if(empty($_POST["user_bio"])){
            $errors[] = "You did not enter your bio";
        }else{
            $bio = $_POST['user_bio'];
        }
            if(empty($errors)){
                $query = "UPDATE users SET bio = '$bio' WHERE user_id='".$userID."'";
                $run = mysqli_query($dbc, $query);
                if($run){
                    echo "<h1> Bio data is successfully inserted the database</h1>";
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
        mysqli_close($dbc);//Close the db connection
            }
    include('footer.php');
?>