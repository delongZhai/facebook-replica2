<?php 
    include('header.php');
    require('mysqli_connect.php');
    session_start();
    $userID = $_SESSION['user_id'][0];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errors = array();
        if(empty($_POST['post'])){
            $errors[]="You did not enter any value";
        }
        else{
            $content = $_POST['post'];
        }

        if(empty($errors)){
            $query = "INSERT INTO posts (user_id, content, date_time) VALUES('$userID', '$content', NOW())";
    
            $run = mysqli_query($dbc, $query);
            if($run){
                echo '<h1>
                Your post is saved in our database;
              </h1>';
            }
            else{
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