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

                <?php
                //just like in the index.php page of getting posts, we do the same thing here to get the posts through the variables they will be sending to us
                //this kind of technique removes the need for creating multiple pages for each post since each post will be stored in the database with its own id
                //this first if part is a continuation of creating the admin panel section
                if(isset($_GET['post_id'])){
                $sel_sql = "SELECT * FROM posts WHERE id = '$_GET[post_id]'";
                $run_sql = mysqli_query($conn, $sel_sql);
                while ($rows = mysqli_fetch_assoc($run_sql)) {
                    echo '
    <div class="panel panel-success">

<div class="panel-heading">
<h3>' . $rows['title'] . '</h3>
</div>

<div class="panel-body">

<img src="' . $rows['image'] . '" alt="" width="100%"> 

<p>' . $rows['description'] . '</p>

</div>

</div> 
    ';
                }
            }else{
                  echo  '<div class="alert alert-success">You did not select any post to show. <a href="index.php">Click Here</a>
                  to select a post</div>';
            }
                ?>

                <!-- copied and pasted all of this in the php code above
<div class="panel panel-default"> here we are creating our panel

<div class="panel-body">

<div class="panel-header">
<h3>The first post</h3>
</div>

<img src="images/justiceleague.jpg" alt="" width="100%"> the width 100% means 100% of he col-lg-8 area 
<p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and 
I will give you a complete account of the system, and expound the actual teachings of the great explorer of 
the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, 
because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter 
consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain 
pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can 
procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, 
except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a 
pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"

But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and 
I will give you a complete account of the system, and expound the actual teachings of the great explorer of 
the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, 
because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter 
consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain 
pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can 
procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, 
except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a 
pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"
</p>

</div>

</div> 
-->
            </section>

            <?php include 'includes/sidebar.php';  //this is where we include our side bar

            ?>

        </article>

    </div>
    <!--here we are creating our navbar -->
    <div style="width:50px;height:50px"></div>

    <?php include 'includes/footer.php';  //this is where we include our footer

    ?>

</body>

</html>