<!--most of this was got from the index.php page-->

<?php
session_start(); //we have to include this function on every page where we want to login and use sessions
include 'includes/database_connection.php';
//checking for the session from our login.php page to secure admin dashboard login. we have to copy and paste this exactly the way it is in all other pages to secure them as well
if (isset($_SESSION['user']) && isset($_SESSION['password']) == true) { //this line means if the username and password are right
    $sel_sql = "SELECT * FROM users WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[password]'";
    if ($run_sql = mysqli_query($conn, $sel_sql)) {
        while ($rows = mysqli_fetch_assoc($run_sql)) {
            if (mysqli_num_rows($run_sql) == 1) {
                if ($rows['role'] == 'admin') {
                } else {
                    header('Location:../index.php'); //redirect to the front end index.php. this is in case someone tries to access the admin panel but they are not an admin 
                }
            } else {
                header('Location:../index.php'); //redirect to the front end index.php. this is in case someone tries to access the admin panel but they are not logged in
            }
        }
    }
} else {
    header('Location:../index.php'); //redirect to the front end index.php
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--used bootstra 3 for the tutorial's sake-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>Admin Panel</title>
</head>

<body>
    <?php include 'includes/header.php'; //including our header and navbar from another file
    ?>
    <div style="width: 50px;height:50px;"></div>
    <!--to leave some empty space for organization-->
    <!--for our side menu bar-->

    <?php include 'includes/sidebar.php'; ?>

    <!--creating the top blocks-->



    <div class="col-lg-10">

        <div style="width: 50px;height:50px;"></div>
        <!--to leave some empty space for organization-->

        <!--start of comments area---->

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Latest Comments</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">

                    <thead>

                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Email</th>
                            <th>Post</th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tr>
                        <tbody>
                            <td>1</td>
                            <td>2015-10-21</td>
                            <td>Michael</td>
                            <td>michael@gmail.com</td>
                            <td>2</td>
                            <td>I like that post</td>
                            <td>Approved</td>
                            <td><a href="#" class="btn btn-danger  btn-xs">Delete</a></td>
                        </tbody>
                    </tr>

                    <tr>
                        <tbody>
                            <td>2</td>
                            <td>2015-10-21</td>
                            <td>Michael</td>
                            <td>michael@gmail.com</td>
                            <td>2</td>
                            <td>I like that post</td>
                            <td><a href="#" class="btn btn-warning  btn-xs">Approve</a></td>
                            <td><a href="#" class="btn btn-danger  btn-xs">Delete</a></td>
                        </tbody>
                    </tr>

                    <tr>
                        <tbody>
                            <td>3</td>
                            <td>2015-10-21</td>
                            <td>Michael</td>
                            <td>michael@gmail.com</td>
                            <td>2</td>
                            <td>I like that post</td>
                            <td>Approved</td>
                            <td><a href="#" class="btn btn-danger  btn-xs">Delete</a></td>
                        </tbody>
                    </tr>

                    <tr>
                        <tbody>
                            <td>4</td>
                            <td>2015-10-21</td>
                            <td>Michael</td>
                            <td>michael@gmail.com</td>
                            <td>2</td>
                            <td>I like that post</td>
                            <td><a href="#" class="btn btn-warning  btn-xs">Approve</a></td>
                            <td><a href="#" class="btn btn-danger  btn-xs">Delete</a></td>
                        </tbody>
                    </tr>

                    <tr>
                        <tbody>
                            <td>5</td>
                            <td>2015-10-21</td>
                            <td>Michael</td>
                            <td>michael@gmail.com</td>
                            <td>2</td>
                            <td>I like that post</td>
                            <td>Approved</td>
                            <td><a href="#" class="btn btn-danger  btn-xs">Delete</a></td>
                        </tbody>
                    </tr>

                </table>

            </div>
        </div>

    </div>

    <footer></footer>

</body>

</html>