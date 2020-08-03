<?php
//Pushed some of this code to github
session_start(); //we have to include this function on every page where we want to login and use sessions
include 'includes/database_connection.php';
$login_err = '';
if (isset($_GET['login_error'])) { //this is in case we are getting errors in our login.php file. open the login.php file to search for these variables
    if ($_GET['login_error'] == 'empty') {
        $login_err = '<div class="alert alert-danger">User name or password is empty!</div>'; //in case user name or password is empty        
    } elseif ($_GET['login_error'] == 'wrong') {
        $login_err = '<div class="alert alert-danger">User name or password is wrong!</div>'; //in case user name or password is wrong
    } elseif ($_GET['login_error'] == 'query_error') {
        $login_err = '<div class="alert alert-danger">Failed to execute database query</div>'; //in case user name or password is wrong
    }
}

//this is a continuation of the pagination at the bottom.
$per_page = 5; //try changing to 1 and refresh the index.php page
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $per_page; //this means that start_from variable will be equal to zero. This continues in the select sql query below

?>

<!DOCTYPE html>

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

    <title>CMS System</title>

</head>

<body>
    <?php include 'includes/header.php'; //including our header and navbar from another file
    ?>
    <!--creating the middle area for our main posts and sub posts-->
    <div class="container">

        <?php echo $login_err; ?>
        <!--to display the login errors-->


        <!--the aricle, section and aside work like the div tags but they are just for proper documentation-->

        <article class="row">
            <!--this is where we structure our content in two columns:-->

            <section class="col-lg-8">
                <!--this first column is main area/content area. The second will be the side area-->
                <!--retieving data from our database for the posts-->
                <!--if the echo part is confusing, look at the commented out html code below it-->
                <!--make sure you can also get variables in the title link for posts otherwise you will get an error of undefined index. that is why we did this in both the title part and read more button-->
                <?php
                $sel_sql = "SELECT * FROM posts WHERE status = 'published' ORDER BY id DESC LIMIT $start_from,$per_page"; //this is to enable only posts with published status to be displayed on the home page. And that the newest posts are displayed first
                //the limit part is having 2 values where one is the starting value and the second is the ending value. In this case, we are only displaying posts from 0 to 5
                $run_sql = mysqli_query($conn, $sel_sql);
                while ($rows = mysqli_fetch_assoc($run_sql)) {

                    echo '
    <div class="panel panel-success">

<div class="panel-heading">
<a href="post.php?post_id=' . $rows['id'] . '"><h3>' . $rows['title'] . '</h3></a>
</div>

<div class="panel-body">

<div class="col-lg-4"> 
<img src="' . $rows['image'] . '" alt="" width="100%"> 
</div>

<div class="col-lg-8">

<p>' . substr($rows['description'], 0, 230) . '.......</p>

</div>

<a href="post.php?post_id=' . $rows['id'] . '" class="btn btn-primary">Read more...</a>'; //getting posts on the post page by sending some variables to our post.php page

                    echo '
</div>

</div> 
    ';
                }
                ?>

                <!-- copied and pasted all of this in the php code above
<div class="panel panel-success"> here we are creating our panel

<div class="panel-heading">
<h3>The first post</h3>
</div>

<div class="panel-body">

<div class="col-lg-4"> trying to put image and post in aligned columns
<img src="images/justiceleague.jpg" alt="" width="100%"> the width 100% means 100% of he col-lg-8 area 
</div>

<div class="col-lg-8">

<p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and 
I will give you a complete account of the system, and expound the actual teachings of the great explorer of 
the truth, the master-builder of human happiness...
</p>

</div>

<a href="post.php" class="btn btn-primary">Read more...</a> linking to the post page

</div>

</div> 
-->
            </section>

            <?php include 'includes/sidebar.php';  //this is where we include our side bar

            ?>

        </article>

        <!--adding pagination for our posts-->
        <div class="text-center">
            <ul class="pagination">

                <?php
                $pagination_sql = "SELECT * FROM posts WHERE status = 'published'";
                $run_pagination = mysqli_query($conn, $pagination_sql);

                $count = mysqli_num_rows($run_pagination); //this is to count the posts having published status in the rows in the above select query 

                $total_pages = ceil($count / $per_page); //the ceil() is to convert a floating number into an integer

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li><a href="index.php?page='.$i. '">' . $i . '</a></li>';
                }

                ?>

            </ul>
        </div>


    </div>
    <!--here we are creating our navbar -->
    <div style="width:50px;height:50px"></div>

    <?php include 'includes/footer.php';  //this is where we include our footer

    ?>

</body>

</html>