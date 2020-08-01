<!--this is where we create our admin panel-->

<?php
session_start(); //we have to include this function on every page where we want to login and use sessions
include 'includes/database_connection.php';
//checking for the session from our login.php page to secure admin dashboard login. we have to copy and paste this exactly the way it is in all other pages to secure them as well
if (isset($_SESSION['user']) && isset($_SESSION['password']) == true) { //this line means if the username and password are right
    $sel_sql = "SELECT * FROM users WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[password]'";
    if ($run_sql = mysqli_query($conn, $sel_sql)) {
        while ($rows = mysqli_fetch_assoc($run_sql)) {
            $name = $rows['user_f_name'] . ' ' . $rows['user_l_name']; //we are getting the name for the profile area of a user logged in at the current session
            $job = $rows['user_designation'];
            $gender = $rows['user_gender'];
            $contact_no = $rows['user_phone_no'];
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

    <?php include 'includes/sidebar.php';

    echo $_SESSION['user']; //this is to enable us know which user is logged into the admin panel. the session was created in the login.php file

    ?>

    <!--creating the top blocks-->

    <div style="width: 50px;height:50px;"></div>
    <!--to leave some empty space for organization-->

    <div class="col-lg-10">

        <!--first block-->
        <div class="col-md-3">

            <!--You can type this php code anywhere you want since we are not echoing anything in it on a particular part of the web page-->
            <?php
            //we want to count posts that are published and display their number on the front page
            $sql = "SELECT * FROM posts WHERE status = 'published'";
            $run = mysqli_query($conn, $sql);
            $total_posts = mysqli_num_rows($run); //this is how we count the posts

            ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"><i class="glyphicon glyphicon-signal" style="font-size: 4.5em"></i></div>
                        <div class="col-xs-9 text-right">
                            <div style="font-size: 2.5em"><?php echo $total_posts; ?></div>
                            <div>Posts</div>

                        </div>

                    </div>

                </div>

                <a href="post_list.php">
                    <div class="panel-footer">
                        <div class="pull-left">View Posts</div>
                        <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
                        <div class="clearfix"></div>
                    </div>
                </a>

            </div>

        </div>

        <!--second block-->
        <div class="col-md-3">

            <!--counting the categories--->

            <?php
            //we want to count categories and display their number on the front page
            $sql = "SELECT * FROM category"; //It will count the home category as well
            $run = mysqli_query($conn, $sql);
            $total_categories = mysqli_num_rows($run); //this is how we count the categories

            ?>

            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"><i class="glyphicon glyphicon-th-list" style="font-size: 4.5em"></i></div>
                        <div class="col-xs-9 text-right">
                            <div style="font-size: 2.5em"><?php echo $total_categories; ?></div>
                            <div>Categories</div>

                        </div>

                    </div>

                </div>

                <a href="category_list.php">
                    <div class="panel-footer">
                        <div class="pull-left">View Categories</div>
                        <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
                        <div class="clearfix"></div>
                    </div>
                </a>

            </div>

        </div>

        <!--third block-->
        <div class="col-md-3">
            <!--counting the users--->

            <?php
            //we want to count users and display their number on the front page
            $sql = "SELECT * FROM users";
            $run = mysqli_query($conn, $sql);
            $total_users = mysqli_num_rows($run); //this is how we count the users

            ?>

            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"><i class="glyphicon glyphicon-user" style="font-size: 4.5em"></i></div>
                        <div class="col-xs-9 text-right">
                            <div style="font-size: 2.5em"><?php echo $total_users; ?></div>
                            <div>Users</div>

                        </div>

                    </div>

                </div>

                <a href="#">
                    <div class="panel-footer">
                        <div class="pull-left">View Users</div>
                        <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
                        <div class="clearfix"></div>
                    </div>
                </a>

            </div>

        </div>

        <!--fourth block-->
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"><i class="glyphicon glyphicon-comment" style="font-size: 4.5em"></i></div>
                        <div class="col-xs-9 text-right">
                            <div style="font-size: 2.5em">6</div>
                            <div>Comments</div>

                        </div>

                    </div>

                </div>

                <a href="#">
                    <div class="panel-footer">
                        <div class="pull-left">View Comments</div>
                        <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
                        <div class="clearfix"></div>
                    </div>
                </a>

            </div>

        </div>

        <!-------- End of Top Blocks ------>

        <!---- start of users area ----->

        <div class="col-lg-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Users List</h4>
                </div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //we want to display the users from the database
                            $sql = "SELECT * FROM users LIMIT 5";
                            $run = mysqli_query($conn, $sql);
                            $number = 1; //for the numbering part in the table
                            while ($rows = mysqli_fetch_assoc($run)) {
                                echo '<tr>
                                    <td>' . $number . '</td>
                                    <td>' . $rows['user_f_name'] . ' ' . $rows['user_l_name'] . '</td>
                                    <td>' . $rows['role'] . '</td>
                            </tr>';
                                $number++;
                            }

                            ?>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>

        <!-- Start of Profile Area -->

        <div class="col-lg-4">

            <div class="panel panel-primary">

                <div class="panel-heading">

                    <div class="col-md-7">

                        <div class="page-header">
                            <h4><?php echo $name; ?></h4>
                        </div>
                    </div>

                    <div class="col-md8">
                        <img src="../images/jona1.jpg" alt="" width="30%" class="img-circle">
                    </div>

                    <div class="panel-body">
                        <table class="table table-condensed">

                            <tbody>
                                <tr>
                                    <th>Job:</th>
                                    <td><?php echo $job; ?></td>
                                </tr>
                                <tr>

                                    <th>Role:</th>
                                    <td><?php echo $_SESSION['role']; ?></td>
                                    <!--we are using a session for admin coz we had already created one at the top-->
                                </tr>
                                <tr>

                                    <th>Email:</th>
                                    <td><?php echo $_SESSION['user']; ?></td>
                                    <!--we are using sessions here as well-->
                                </tr>

                                <tr>

                                    <th>Contact:</th>
                                    <td><?php echo $contact_no; ?></td>
                                </tr>

                                <tr>

                                    <th>Gender</th>
                                    <td><?php echo $gender; ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>

        <div class="clearfix"></div>
        <!--to clear the floating-->

        <!-------Start of Post Blocks which will be linked to our table posts in the database of cms_system------>

        <div class="clearfix"></div>
        <!--to clear the floating-->

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Latest Posts</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">

                    <thead>

                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Author</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!--getting the posts from the database-->
                        <?php
                        $sql = "SELECT * FROM posts p JOIN category c ON c.c_id=p.category WHERE p.author = '$_SESSION[user]' AND p.status = 'published'"; //displaying published posts for currently logged in author. we are joining the 2 tables to get columns that are in different tables
                        /*if the above sql command fails, try running this in stead. And where there is category_name below, type just category
                        sql = "SELECT * FROM posts WHERE author = '$_SESSION[user]' AND status = 'published';
                        */
                        $run = mysqli_query($conn, $sql);
                        $number = 1;
                        while ($rows = mysqli_fetch_assoc($run)) {
                            echo '<tr>
                                        <td>'.$number. '</td>
                                        <td>' . $rows['date'] . '</td>
                                        <td><img src="../' . $rows['image'] . '" alt="" width="70px"></td> <!--this is how we echo the images because they are in a back directory-->
                                        <td>' . $rows['title'] . '</td>
                                        <td>' . substr($rows['description'],0,50) . '....</td>
                                        <td>' . ucfirst($rows['category_name']) . '</td>
                                        <td>' . $name . '</td>

                        </tr>';
                        $number++;
                        }

                        ?>
                        
                    </tbody>

                </table>

            </div>
        </div>
        <!-- end of latest posts area-->

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
                        </tbody>
                    </tr>

                </table>

            </div>
        </div>

    </div>

    <footer></footer>

</body>

</html>