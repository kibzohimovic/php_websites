<!--we are creating a header and navbar for our cms -->
<!--the reason we are creating it in its own file so that we can use the include function to include it in other pages as well which saves time and leads to uniformity-->
<header class="navbar navbar-inverse navbar-static-top">
    <!--background color and styling of navbar -->
    <div class="container">
        <a href="index.php" class="navbar-brand">CMS Website</a>
        <!--this is where we add the navigation links and buttons-->
        <ul class="nav navbar-nav navbar-right">
            <!--we replaced this with our home ctegory in the php code
            <li class="active"><a href="index.php">Home</a></li>
            -->
            <!--we are adding a category menu for our posts-->
            <?php
            $sel_cat = "SELECT * FROM category";
            $run_cat = mysqli_query($conn, $sel_cat);
            while ($rows = mysqli_fetch_assoc($run_cat)) {
                if (isset($_GET['cat_name'])) { //make sure that this matches the category_name in the table and its case sensitive
                    if ($_GET['cat_name'] == $rows['category_name']) { //we are trying to change the active menu button clicked by the help of database
                        $class = 'active';
                    } else {
                        $class = '';
                    }
                } else {
                    $class = ''; //this will work for the index page since the cat_name variable won't be set
                }
                if($rows['category_name'] == 'home'){ 
                    if($_SERVER['PHP_SELF'] == '/php tutorials/creating a cms system/index.php'){ //this means if the $_SERVER array returns the home file, then execute this code to make the home tab active
                        echo '<li class="active"><a href="index.php">' . ucfirst($rows['category_name']) . '</a></li>';
                    }
                    else{
                        echo '<li class=""><a href="index.php">' . ucfirst($rows['category_name']) . '</a></li>';
                    }
                    
                }
                else{
                    echo '<li class="' . $class . '"><a href="menu.php?cat_name='.$rows['category_name'].'">'.ucfirst($rows['category_name']) . '</a></li>'; //we are getting these variables from index.php file
                }
                
            }
            ?>

            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="registration.php">Register</a></li>
        </ul>

    </div>

</header>