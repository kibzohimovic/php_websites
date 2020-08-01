<!--Most of this was got from the new_post.php file--->

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
//this is for the new category part
$result = '';
if(isset($_POST['submit_category'])){
    $category = strip_tags($_POST['category']);
    $sql = "INSERT INTO category(category_name) VALUES('$category')";
    if(mysqli_query($conn,$sql)){
        $result = '<div class="alert alert-success">You&apos;ve created a new category named &apos;'.$category.'&apos;</div>';
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

    <!--tinymce text editor-->

    <script src="https://cdn.tiny.cloud/1/muaw8twtexzl5bq1scqpf0sbaycxi95o2ruyrq6uj64i8km5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>

    <!--ends here-->

    <title>Admin Panel</title>
</head>

<body>
    <?php include 'includes/header.php'; //including our header and navbar from another file
    ?>
    <div style="width: 50px;height:50px;"></div>
    <!--to leave some empty space for organization-->
    <!--for our side menu bar-->

    <?php include 'includes/sidebar.php'; 
    echo $result;
    
    ?>

    <div class="col-lg-10">

        <div class="page-header">
            <h1>New Post</h1>
        </div>

        <div class="container-fluid">

            <form action="new_category.php" class="form-horizontal col-lg-5" method="post">

                <div class="form-group">
                    <label for="category" class="">Title</label>
                    <input type="text" id="category" name="category" class="form-control">

                </div>

                <div class="form-group">
                    <input type="submit" name="submit_category" class="btn btn-danger btn-block">

                </div>

            </form>

        </div>

    </div>

    <footer></footer>

</body>

</html>