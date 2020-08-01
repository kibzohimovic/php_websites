<!--most of this was got from the contactus.php page and some things were edited out-->

<?php
include 'includes/database_connection.php';

$match = '';
if (isset($_POST['submit_user'])) { //we are writing our php here because we are receiving the form in the same page
    $date = date('Y-m-d h:i:s'); //date function because we are using time stamp which will be obtained automatically

    //this is how we validate passwords
    if ($_POST['password'] == $_POST['con_password']) {
        //by default, all users will have the role of subscriber. it will be up to us to change their role in the database
        $ins_sql = "INSERT INTO users(role,user_f_name,user_l_name,user_email,user_password,user_gender,user_marital_status,user_phone_no,
    user_designation,user_website,user_address,
    user_about_me,user_date) VALUES('subscriber','$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[password]','$_POST[gender]',
    '$_POST[marital_status]', '$_POST[phone_no]','$_POST[designation]','$_POST[website]','$_POST[address]', '$_POST[about_me]', '$date')"; //if you wanted, you could have first assigned these post variables to variables
        $run_sql = mysqli_query($conn, $ins_sql);
    } else {
        $match = '<div class="alert alert-danger">Password doesn&apost match!</div>';
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

    <title>CMS System</title>

</head>

<body>
    <?php include 'includes/header.php'; //including our header and navbar from another file
    ?>
    <!--creating the middle area for our main posts and sub posts-->
    <div class="container">
        <!--the aricle, section and aside work like the div tags but they are just for proper documentation-->

        <article class="row">
            <!--this is where we are creating our contact us page:-->

            <section class="col-lg-8">
                <div class="page-header">
                    <h2>Registration Form</h2>
                </div>

                <?php echo $match; ?>
                <!--error message that should be displayed in case passwords don't match-->


                <form action="registration.php" class="form-horizontal" method="post" role="form">

                    <div class="form-group">
                        <label for="first_name" class="col-sm-3 control-label">First Name *</label>
                        <div class="col-sm-8">
                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Insert your Name" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="last_name" class="col-sm-3 control-label">Last Name *</label>
                        <div class="col-sm-8">
                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Insert your Name" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email Address *</label>
                        <div class="col-sm-8">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Insert your Email Address" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password *</label>
                        <div class="col-sm-8">
                            <input type="password" id="password" name="password" class="form-control" name="password" placeholder="Insert your password" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="con_password" class="col-sm-3 control-label">Confirm Password *</label>
                        <div class="col-sm-8">
                            <input type="password" id="con_password" name="con_password" class="form-control" name="con_password" placeholder="Confirm password" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="gender" class="col-sm-3 control-label">Gender *</label>
                        <div class="col-sm-3">
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <!-- we commented these out so that we could have the marital status on the same line as gender

                    </div>

                    <div class="form-group">
-->

                        <label for="marital_status" class="col-sm-2 control-label">Marital Status</label>
                        <div class="col-sm-3">
                            <select name="marital_status" id="marital_status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="others">Others</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="phone_no" class="col-sm-3 control-label">Phone No. *</label>
                        <div class="col-sm-8">
                            <input type="text" id="phone_no" class="form-control" name="phone_no" placeholder="Insert your contact number" required>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="designation" class="col-sm-3 control-label">Designation</label>
                        <div class="col-sm-8">
                            <input type="text" id="designation" class="form-control" name="designation" placeholder="Insert your designation">
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="website" class="col-sm-3 control-label">Official Website</label>
                        <div class="col-sm-8">
                            <input type="text" id="website" class="form-control" name="website" placeholder="Insert your official website">
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-8">
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control" style="resize: none"></textarea>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="about_me" class="col-sm-3 control-label">About Me *</label>
                        <div class="col-sm-8">
                            <textarea name="about_me" id="about_me" cols="30" rows="5" class="form-control" style="resize: none" required></textarea>
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label"></label>
                        <div class="col-sm-8">
                            <input type="submit" id="name" class="btn btn-block btn-primary" value="Register" name="submit_user">
                            <!--make sure the id matches the value in for attribute in label-->
                        </div>

                    </div>

                </form>
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