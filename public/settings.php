<!DOCTYPE html> 
<html lang="en"> 

<head>
    <title>Settings</title>
</head>

<body>

<?php
    require ('mysqli_connect.php');
    session_start();
    $userID =$_SESSION['user_id'][0];

    $query= "SELECT user_id,first_name,last_name,email FROM users WHERE user_id='$userID'";
    $run = mysqli_query($dbc , $query);
    $num = mysqli_num_rows($run);
    if($num>0){
        echo "<table border='1' class='table'>";
		while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)){ 
		echo "<tr>
				<td>".$row['first_name']."</td>
				<td>".$row['last_name']." </td>
				<td>".$row['email']." </td>
                <td><a href='edit.php?id={$row['user_id']}'</a>Edit</td>
			 </tr>";
		}
		echo "</table>";
	}
    mysqli_close($dbc);
?>

</body>

</html> 