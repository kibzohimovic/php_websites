<!--we are creating a header and navbar for our cms admin panel-->
<!--the reason we are creating it in its own file so that we can use the include function to include it in other pages as well which saves time and leads to uniformity-->
<header class="navbar navbar-default navbar-fixed-top">
    <!--background color and styling of navbar -->
    <div class="container">
        <a href="index.php" class="navbar-brand">CMS Website</a>
        <!--this is where we add the navigation links and buttons-->
        <ul class="nav navbar-nav navbar-right">                       

            <li><a href="index.php">Home</a></li>
            <li><a href="../accounts/logout.php">Log Out</a></li>
        </ul>

    </div>

</header>