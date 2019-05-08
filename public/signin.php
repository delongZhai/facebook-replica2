<?php 
    include('header.php');
    require('mysqli_connect.php');

    if(isset($_POST['user'])){
        $uname=$_POST['user'];
        $password=$_POST['pass'];

        $sql= "SELECT email, password FROM users WHERE email='".$uname."' AND password='".SHA1($password)."' limit 1";

        $run = mysqli_query($dbc, $sql);
        if(mysqli_num_rows($run)==1){
            $info= "SELECT first_name,last_name,birthday,gender FROM users WHERE email='".$uname."'";

            $inforun = mysqli_query($dbc, $info);
            $num = mysqli_num_rows($inforun);

            while ($row = mysqli_fetch_array($inforun, MYSQLI_ASSOC)){ 
                session_start();
                $id = "SELECT user_id FROM users WHERE email='".$uname."'";
                $id_info = mysqli_query($dbc, $id);
                $id_info = mysqli_fetch_array($id_info);
                $user_id = $id_info[0];

                $_SESSION['user_id'] = $id_info;
                if(isset($_SESSION['user_id'])){
                    if ($_SESSION['user_id'] != NULL){
                    //     for($i = 0 ; $i < sizeof($_SESSION['user_id']) ; $i++) {
                    //         echo '<td>'.$_SESSION['user_id'][$i].'</td>';
                    //     }
                        // echo $_SESSION['user_id'][0];
                        require_once ('home.php');
                    }
                }
                else{
                    echo "<h1> Session is not started</h1>";
                }
            }
        }
        else{
            echo "Incorrect username or password. Try again";
            exit();
        }
    }
    mysqli_close($dbc);
    
    include('footer.php');
?>
    