<!--most of this was got from the index.php file-->

<!--this is where we create our view posts page-->

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
//this for the status part when you click published or draft buttons. this begins from the html and php code below where we began sending the variables. we receive them here
$result = '';
if(isset($_GET['new_status'])){
    $new_status = $_GET['new_status'];
    $sql = "UPDATE posts SET status = '$new_status' WHERE id = $_GET[id]";
    if($run = mysqli_query($conn, $sql)){
        $result = '<div class="alert alert-success">We just updated the status</div>';

    }

}

//this is for the delete button
if(isset($_GET['del_id'])){
    $del_id = $_GET['del_id'];
    $sql = "DELETE FROM posts WHERE id = '$del_id'";
    if($run = mysqli_query($conn,$sql)){
        $result = '<div class="alert alert-danger">You deleted row no. '.$del_id.' from the database</div>';
    }

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

        <!-------Start of Post Blocks which will be linked to our table posts in the database of cms_system------>

        <?php //what will be displayed after updating the status
        echo $result;

        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Posts</h3>
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
                            <th>Status</th>
                            <th>Action</th>
                            <th>Edit Post</th>
                            <th>View Post</th>
                            <th>Delete Post</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        //$sql = "SELECT * FROM posts ORDER BY ID DESC";
                        $sql = "SELECT * FROM posts p JOIN users u ON p.author = u.user_email"; //we are joining 2 tables since the author name we want to use is in another table
                        //the p and u are short names for the 2 tables
                        $run = mysqli_query($conn,$sql);
                        while($rows = mysqli_fetch_assoc($run)){
                            //we are getting this from the database. notice how we used the operators in the image part. it is more like an if else in case there is a post without an image, then no image text should be displayed
                            //the same thing above was used for the status part to change it from published to draft by clicking a button
                            echo '
                            <tr>
                                <td>1</td>
                                <td>2015-10-21</td>
                                <td>'.($rows['image'] == '' ? 'No Image' : '<img src= "../'.$rows['image'].'" width="50px">'). '</td>
                                <td>' . $rows['title'] . '</td>
                                <td>' . substr($rows['image'],0,50). '....</td>
                                <td>' . $rows['category'] . '</td>
                                <td>'.$rows['user_f_name']. ' ' . $rows['user_l_name'] . '</td>
                                <td>' . $rows['Status'] . '</td>
                                <td>'.($rows['Status'] == 'draft' ? '<a href="post_list.php?new_status=published&id='.$rows['id'].'" class="btn btn-primary 
                        btn-xs navbar-btn">Publish</a> ' : '<a href="post_list.php?new_status=draft&id=' . $rows['id'] . '" class="btn btn-info 
                        btn-xs navbar-btn">Draft</a>').'</td>

                                <td><a href="#" class="btn btn-warning btn-xs navbar-btn">Edit</a></td>
                                <!--navbar-btn class is to put the buttons in the center-->
                                <td><a href="../post.php?post_id='.$rows['id'].'" class="btn btn-success btn-xs navbar-btn">View</a></td>
                                <td><a href="post_list.php?del_id='.$rows['id'].'" class="btn btn-danger btn-xs navbar-btn">Delete</a></td>
                        </tr>
                            
                            ';
                        }
                        
                        ?>
                        
                    </tbody>
                </table>

            </div>
        </div>
        <!-- end of latest posts area-->

        <!--we are adding our pagination here. for a more accurate pagination, refer to the one in the index/php file-->
        <div class="text-center">
            <ul class="pagination">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">5</a></li>

            </ul>

        </div>

    </div>

    <footer></footer>

</body>

</html>