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

//time to receive the form
$error = '';

if (isset($_POST['submit_post'])) {
    $title = strip_tags($_POST['title']);
    $date = date('Y-m-d h:i:s');
    //this is how we upload an image
    if ($_FILES['image']['name'] != '') { //the $_FILES is a super array for uploading files. in the square bracket is the value of the name attribute from the input field for uploading an image
        $image_name = $_FILES['image']['name']; // this is a multi dimensional array and the second input is for the image name
        $image_tmp = $_FILES['image']['tmp_name']; //this is for the name of the image in the temporary files
        $image_size = $_FILES['image']['size']; //this is for the image size
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION); //getting the file extension
        $image_path = '../images/' . $image_name; //folder where image should be stored
        $image_db_path = 'images/' . $image_name; //the name of the image in the database table of how it will be stored

        if ($image_size < 1000000) { //the image size is measured in bytes
            if ($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif') {
                if (move_uploaded_file($image_tmp, $image_path)) { //This function moves an uploaded file to a new destination.
                    //this is the area where we create our sql query for inserting data into the database
                    $ins_sql = "INSERT INTO posts (title, description, image, category, status, date, author) VALUES('$title', '$_POST[description]'
                    ,'$image_db_path','$_POST[category]','$_POST[status]','$date','$_SESSION[user]')";

                    if (mysqli_query($conn, $ins_sql)) {
                        header('post_list.php');
                    } else {
                        $error = '<div class="alert alert-danger">Failed to execute the query</div>';
                    }
                } else {
                    $error = '<div class="alert alert-danger">Sorry, Unfortunately Image has not been uploaded</div>';
                }
            } else {
                $error = '<div class="alert alert-danger">Image format is not supported</div>';
            }
        } else {
            $error = '<div class="alert alert-danger">Image size exceeds 1MB</div>';
        }
    } else {
        //this part is to make sure that a post can be submitted without an image. this time we don't insert anything in the image column
        $ins_sql = "INSERT INTO posts (title, description, category, date, author) VALUES('$title', '$_POST[description]'
                    ,'$_POST[category]','$date','$_SESSION[user]')";
        if (mysqli_query($conn, $ins_sql)) {
            header('post_list.php');
        } else {
            $error = '<div class="alert alert-danger">Failed to execute the query</div>';
        }
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

    echo $error;

    ?>

    <div class="col-lg-10">

        <?php
        if (isset($_GET['edit_id'])) {
            $sql = "SELECT * FROM posts WHERE id = $_GET[edit_id]";
            $run = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_assoc($run)) { ?>

                <!--we cut all this and pasted it here in the php-->
                <div class="page-header">
                    <h1><?php echo $rows['title']; ?></h1>
                </div>

                <div class="container-fluid">

                    <form action="new_post.php" class="form-horizontal" method="post" enctype="multipart/form-data">

                        <img src="../<?php echo $rows['image']; ?>" alt="" width="100px">
                        <!--since the image to be edited is in a back directory-->

                        <div class="form-group">

                            <label for="image" class="">Upload An Image</label>
                            <input type="file" id="image" name="image" class="btn btn-primary">
                            <!--this is how we upload files-->

                        </div>

                        <div class="form-group">
                            <label for="title" class="">Title *</label>
                            <input type="text" id="title" value="<?php echo $rows['title']; ?>" name="title" class="form-control" required>

                        </div>

                        <div class="form-group">
                            <label for="category" class="">Category *</label>
                            <select id="category" name="category" id="category" class="form-control" required>
                                <!--getting the categories from our database-->
                                <option value="">Select Any Category</option>
                                <?php
                                $sel_sql = "SELECT * FROM category";
                                $run_sql = mysqli_query($conn, $sel_sql);
                                while ($c_rows = mysqli_fetch_assoc($run_sql)) {
                                    if ($c_rows['category_name'] == 'home') { //the reason we are doing this is to ignore the home category in our database
                                        continue; //meaning that ignore the home category

                                    }
                                    echo '<option value="' . $c_rows['category_name'] . '">' . ucfirst($c_rows['category_name']) . '</option>';
                                }

                                ?>

                            </select>

                        </div>

                        <div class="form-group">
                            <label for="description" class="">Description *</label>
                            <textarea name="description" id="description" cols="30" rows="3"><?php echo $rows['description']; ?></textarea>
                            <!--The required attribute can't work coz of the javascript in the tiny mce editor-->
                            <!--we are using the tinymce text editor-->

                        </div>

                        <div class="form-group">
                            <label for="status" class="">Status *</label>
                            <select id="status" name="status" id="" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit_post" class="btn btn-danger btn-block">

                        </div>

                    </form>

                </div>


        <?php }
        } else {
            echo '<div class="alert alert-danger">Please Select a post to edit</div>';
        }

        ?>

    </div>

    <footer></footer>

</body>

</html>