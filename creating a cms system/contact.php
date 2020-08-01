<!--this is our contact us form-->
<!--most of this was got from the index.php page and some things were edited out-->
<?php
include 'includes/database_connection.php';
include 'includes/header.php'; //we include the header file as well
if (isset($_POST['submit_btn'])) { //we are writing our php here because we are receiving the form in the same page
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $comment = $_POST['comment'];
    $date = date('Y-m-d h:i:s'); //date function because we are using time stamp which will be obtained automatically

    $ins_sql = "INSERT INTO comments(name,email,subject,comment,date) VALUES('$name','$email','$subject','$comment','$date')"; //if you wanted, you could have first assigned these post variables to variables
    $run_sql = mysqli_query($conn, $ins_sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--used bootstrap 3 for the tutorial's sake-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>CMS SYSTEM</title>
</head>

<body>

    <!--creating the middle area for our main posts and sub posts-->
    <div class="container">
        <!--the aricle, section and aside work like the div tags but they are just for proper documentation-->

        <article class="row">
            <!--this is where we are creating our contact us page:-->

            <section class="col-lg-8">
                <div class="jumbotron">
                    <h2>Contact Us</h2>
                </div>

                <form action="contact.php" class="form-horizontal" method="post" role="form">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Insert your Name" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email Address</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Insert your Email Address" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-8">
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Insert your Subject" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="comments" class="col-sm-2 control-label">Comments</label>
                        <div class="col-sm-8">
                            <textarea name="comment" id="" class="form-control" cols="30" rows="8" style="resize: none" required></textarea>
                            <!--the resize none is to prevent someone from stretching it on the user page-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <input type="submit" id="submit_btn" name="submit_btn" class="btn btn-block btn-primary" value="Submit Form">
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                </form>
            </section>

            <?php include 'includes/sidebar.php';  //this is where we include our side bar

            ?>

        </article>

    </div>

    <div style="width:50px;height:50px;"></div>

    <?php include 'includes/footer.php' ?>

</body>

</html>