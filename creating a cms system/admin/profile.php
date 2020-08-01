<!--most of this was got from the index.php file-->

<?php
session_start(); //we have to include this function on every page where we want to login and use sessions
include 'includes/database_connection.php';
//checking for the session from our login.php page to secure admin dashboard login. we have to copy and paste this exactly the way it is in all other pages to secure them as well
if (isset($_SESSION['user']) && isset($_SESSION['password']) == true) { //this line means if the username and password are right
    $sel_sql = "SELECT * FROM users WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[password]'";
    if ($run_sql = mysqli_query($conn, $sel_sql)) {
        while ($rows = mysqli_fetch_assoc($run_sql)) {
            //here we are trying to display the profile details of our users in the profile.php page

            $user_f_name = $rows['user_f_name'];
            $user_l_name = $rows['user_l_name'];
            $user_gender = $rows['user_gender'];
            $user_marital_status = $rows['user_marital_status'];
            $user_phone_no = $rows['user_phone_no'];
            $user_designation = $rows['user_designation'];
            $user_website = $rows['user_website'];
            $user_address = $rows['user_address'];
            $user_about_me = $rows['user_about_me'];

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

    <div class="col-lg-10">

        <div style="width: 50px;height:50px;"></div>
        <!--to leave some empty space for organization-->

        <!-- Start of Profile Area -->

        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading">

                    <div class="col-md-3">
                        <img src="../images/jona1.jpg" alt="" width="100%" class="img-thumbnail">
                    </div>

                    <div class="col-md-7">
                        <!--displaying the profile details from the database-->

                        <h4><u> <?php echo $user_f_name . ' ' . $user_l_name; ?></u></h4>
                        <p><i class="glyphicon glyphicon-heart"></i> <?php echo $user_designation; ?></p>
                        <p><i class="glyphicon glyphicon-road"></i> <?php echo $user_address; ?></p>
                        <p><i class="glyphicon glyphicon-phone"></i> <?php echo $user_phone_no; ?></p>
                        <p><i class="glyphicon glyphicon-envelope"></i> <?php echo $_SESSION['user']; ?></p>
                        <!--reason we are using this is because we had already created a session of the email for a logged in user-->


                    </div>
                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <th>Gender</th>
                                <td><?php echo ucfirst($user_gender); ?></td>
                            </tr>
                            <tr>
                                <th>M. Status</th>
                                <td><?php echo ucfirst($user_marital_status); ?></td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td><?php echo $user_website; ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td width="10%">1</td>
                                <td>
                                    <a href="#">The First Post</a>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">2</td>
                                <td>
                                    <a href="#">The Second Post</a>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">3</td>
                                <td>
                                    <a href="#">The Third Post</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>About Me</h4>
                    <p><?php echo $user_about_me; ?></p>

                </div>

            </div>

        </div>


    </div>

    <footer></footer>

</body>

</html>