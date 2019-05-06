<?php
    require ('mysqli_connect.php');
    include ('header.php');
    
    if(isset($_POST['button'])){
        $search=$_GET['search'];
   
        $result = "SELECT * FROM users WHERE ('first_name' LIKE '%{$search}%') OR ('last_name' LIKE '%{$search}%')";
        $run = mysqli_query($dbc, $result);
        $num=mysqli_num_rows($run);
        if($num > 0){ 
            echo "<p>There are currently $num registered users</p>";
            while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) { 
            echo "<p>".$row['first_name']." ".$row['last_name']."</p>";
            }
        }
        else{
            echo "No users with".$row['first_name']." and " .$row['last_name']." exist in the database";
        }
    }
    mysqli_close($dbc);
    include ('footer.php');
?>