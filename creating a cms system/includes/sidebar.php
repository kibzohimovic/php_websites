<!--we have decided to separate the side bar-->


<aside class="col-lg-4">
    <!--side area-->
    <!--this is especially important for creating forms-->

    <form action="search.php" class="panel-group form-horizontal" role="form">
        <!--here we are creating a search bar-->

        <div class="panel panel-default">

            <div class="panel-body">

                <div class="panel-header">
                    <h4>Search Something</h4>
                </div>

                <div class="input-group col-sm-10">
                    <input type="search" name="search" class="form-control" placeholder="search something....">
                    <div class="input-group-btn">
                        <!--for putting the search button side by side the input field-->
                        <button class="btn btn-info" name="search_submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        <!--this is how we add search glyphicon -->
                    </div>
                </div>

            </div>

        </div>

    </form>

    <form action="accounts/login.php" role="form" class="panel-group form-horizontal" method="post">
        <!--login form -->

        <div class="panel panel-default">

            <div class="panel-heading">Login Area</div>
            <!--title for our panel should be above panel body-->

            <div class="panel-body">

                <div class="form-group">
                    <label for="user_name" class="control-label col-sm-4">User Name</label>
                    <div class="col-sm-7">
                        <input type="text" id="user_name" class="form-control" name="user_name" placeholder="Insert Email">
                        <!--make sure the for attribute in level matches the id attribute in input tag-->
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label col-sm-4">Password</label>
                    <div class="col-sm-7">
                        <input type="password" id="username" name="password" class="form-control" placeholder="Insert password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-success btn-block" name="submit_login">
                    </div>
                </div>


            </div>

        </div>

    </form>

    <!--Here we are creating latest post and aside area using bootstrap -->

    <div class="list-group">

        <?php
        $sel_side = "SELECT * FROM posts WHERE status = 'published' ORDER BY id DESC LIMIT 2"; //this is to limit the number of posts to be displayed
        $run_side = mysqli_query($conn, $sel_side);
        while ($rows = mysqli_fetch_assoc($run_side)) {

            if (isset($_GET['post_id'])) { //trying to make a side post active in its page when it is clicked

                if ($_GET['post_id'] == $rows['id']) {
                    $class = 'active';
                } else {
                    $class = '';
                }
            } else {
                $class = '';
            }

            echo ' <a href="post.php?post_id=' . $rows['id'] . '" class="list-group-item ' . $class . '">
                        <div class="col-sm-4">
                           <img src="' . $rows['image'] . '" width="100%">
                        </div>
                        <div class="col-sm-8">
                        <h4 class="list-group-item-heading">' . $rows['title'] . '</h4>
                        <p class="list-group-item-text">' . substr($rows['description'], 0, 50) . '......</p>
                        </div>     
                        
                        <div style="clear:both"></div>
                    </a>
                    
                    
                    ';
        }
        ?>
        <!--pasted this in the php code above
                    <a href="#" class="list-group-item active">
                        <h4 class="list-group-item-heading">Lorem Ipsum</h4>
                        <p class="list-group-item-text">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born</p>
                    </a>
                    -->

    </div>

</aside>