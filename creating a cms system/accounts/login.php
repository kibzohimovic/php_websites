<!--we have to first create a session to enable login on our front end side bar-->
<?php
session_start(); //we have to include this function on every page where we want to login
include '../includes/database_connection.php'; //the database connection for the cms system database
if(isset($_POST['submit_login'])){
    if(!empty($_POST['user_name']) && !empty($_POST['password'])){ //this means that you will only login if both password and username are correct
        $get_user_name =mysqli_real_escape_string($conn,$_POST['user_name']); //this function is to prevent SQL injection
        $get_password = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "SELECT * FROM users WHERE user_email = '$get_user_name' AND user_password = '$get_password' "; //they are checking for both username and password 
            if($result = mysqli_query($conn, $sql)){
                while($rows = mysqli_fetch_assoc($result)){
                if (mysqli_num_rows($result) == 1) { //the reason we are saying 1 is because username and password are unique so we have to strictly get results from one row
                    $_SESSION['user'] = $get_user_name; //this is just a way of creating a session on the whole server in just one file. And it is a way of securing our admin panel 
                    $_SESSION['password'] = $get_password;
                    $_SESSION['role'] = $rows['role']; //this is ensuring that only admins can log in the admin panel
                    header('Location:../admin/index.php'); //redirect to the admin panel
                } else {
                    header('Location:../index.php?login_error=wrong'); //remain in the user side coz credentials are wrong
                }

                }
            }
            else{
            header('Location:../index.php?login_error=query_error'); //means mysqli_query() couldn't be executed
            }
    }
    else{
        header('Location:../index.php?login_error=empty');  //means no login credentials entered
    }

}
else{

}

?>