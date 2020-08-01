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

//receiving the delete and edit variables
$result = '';
if(isset($_GET['del_id'])){
    $del_sql = "DELETE FROM category WHERE c_id = '$_GET[del_id]'";
    if(mysqli_query($conn,$del_sql)){
        $result = '<div class="alert alert-danger">You deleted category no. ' . $_GET['del_id'] . ' from the category table</div>';
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

    <!--creating the top blocks-->

    <div style="width: 50px;height:50px;"></div>
    <!--to leave some empty space for organization-->

    <div class="col-lg-10">


        <?php echo $result; ?>

        <div class="col-lg-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Categories</h4>
                </div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Category Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--to retrieve the categories from the category table in the database-->
                            <?php
                            $sql = "SELECT * FROM category";
                            $run = mysqli_query($conn,$sql);
                            $number = 1; //for the S.No part
                            while($rows = mysqli_fetch_assoc($run)){

                                if($rows['category_name'] == 'home'){
                                    continue;
                                }
                                else{
                                    $category_name = ucfirst($rows['category_name']);
                                }

                                echo '<tr>
                                <td>'.$number.'</td>
                                <td>'.$category_name. '<td>
                                <td><a href="edit_category.php?cat_id=' . $rows['c_id'] . '"" class="btn btn-warning  btn-xs">Edit</a></td>
                                <td><a href="category_list.php?del_id='.$rows['c_id'].'" class="btn btn-danger  btn-xs">Delete</a></td>
                                </tr>';

                                $number++;

                            }

                            ?>


                        </tbody>
                    </table>
                </div>

            </div>

        </div>


    </div>

    <footer></footer>

</body>

</html>