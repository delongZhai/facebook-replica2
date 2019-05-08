
<?php
    require ('mysqli_connect.php');
    include ('header.php');
    
    if(isset($_POST['search'])){
        $search=$_POST['search'];
   
        $result = "SELECT * FROM users WHERE (first_name LIKE '%$search%') OR (last_name LIKE '%$search%')";
        $run = mysqli_query($dbc, $result);
        $num=mysqli_num_rows($run);
        if($num > 0){ 
            echo "<p>There are currently $num registered users</p>";
            echo "<table border='1' class='table'>";
            while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) { 
                echo "<tr>
                        <td>".$row['first_name']."</td>
                        <td>".$row['last_name']." </td>
                        <td>".$row['email']." </td>
                        <td><a href='#?id={$row['user_id']}'</a>Add Friend</td>
                    </tr>";
            }
            echo "</table>";
        }
        else{
            echo "No users found";
        }
    }
    mysqli_close($dbc);
    include ('footer.php');
?>