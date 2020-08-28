<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">



        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>



        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php

                $query = "SELECT * FROM categories";
                $selectAllCategoriesQuerry = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($selectAllCategoriesQuerry)) {
                    $categoryTitle = $row['categoryTitle'];
                    $categoryId = $row['categoryId'];
                    echo "<li><a href='category.php?category=$categoryId'>{$categoryTitle}</a></li>";
                }

                ?>


                <li>
                    <a href="admin/admin.php">Admin</a>
                </li>
                <li>
                    <a href="registration.php">Registration</a>
                </li>

                <?php

                if (isset($_SESSION['role'])) {

                    if (isset($_GET['pId'])) {
                        $thePostId = $_GET['pId'];
                        echo "<li><a href='admin/posts.php?source=editPost&pId=$thePostId'>Edit Post </a></li>";
                    }
                }

                ?>



            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>