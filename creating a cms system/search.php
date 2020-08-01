<!--all this was got from the menu.php-->

<?php
include 'includes/database_connection.php';
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

    <title>CMS System</title>

</head>

<body>
    <?php include 'includes/header.php'; //including our header and navbar from another file
    ?>

    <!--creating the middle area for our main posts and sub posts-->
    <div class="container">
        <!--the aricle, section and aside work like the div tags but they are just for proper documentation-->

        
        <article class="row">
            <!--this is where we structure our content in two columns:-->

            <section class="col-lg-8">
                <!--this first column is main area/content area. The second will be the side area-->
                <!--retieving data from our database for the posts-->
                <!--if the echo part is confusing, look at the commented out html code below it-->
                <!--make sure you can also get variables in the title link for posts otherwise you will get an error of undefined index. that is why we did this in both the title part and read more button-->
                <?php
                if(isset($_GET['search_submit'])){
                    echo '
                    <div class="panel panel-default">
                      <div class="panel-body">
                    <h4>You searched for "'.$_GET['search'].'"</h4>
                    </div>
                  </div>
                    ';

                    $sel_sql = "SELECT * FROM posts WHERE title LIKE '%$_GET[search]%' OR title LIKE '%$_GET[search]%'"; //we want to search for a post. we are using the like and % wildcard in case something matches our search. the OR part is to find a matching word in the description
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

    </div>
    <!--here we are creating our footer -->
    <div style="width:50px;height:50px"></div>

    <?php include 'includes/footer.php';  //this is where we include our footer

    ?>


</body>

</html>