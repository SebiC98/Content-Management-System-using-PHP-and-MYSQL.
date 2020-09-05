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
            <a class="navbar-brand" href="/cms">Home</a>
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

                    $categoryClass = '';
                    $registrationClass = '';
                    $contactClass = '';


                    $pageName = basename($_SERVER['PHP_SELF']);
                    $registration = 'registration.php';
                    $contact = 'contact.php';

                    if (isset($_GET['category']) && $_GET['category'] == $categoryId) {
                        $categoryClass = 'active';
                    } else if ($pageName == $registration) {
                        $registrationClass = 'active';
                    } else if ($pageName == $contact) {
                        $contactClass = 'active';
                    }
                    echo "<li class='$categoryClass'><a href='/cms/category/$categoryId'>{$categoryTitle}</a></li>";
                }

                ?>

                <?php if (isset($_SESSION['role'])=='admin') {
                ?>
                    <li>
                        <a href="/cms/admin/admin.php">Admin</a>
                    </li>
                <?php } ?>

                <li class='<?php echo $registrationClass; ?>'>
                    <a href="/cms/registration">Registration</a>
                </li>
                <li class='<?php echo $contactClass; ?>'>
                    <a href="/cms/contact">Contact</a>
                </li>

                <?php

                if (isset($_SESSION['role'])) {

                    if (isset($_GET['pId'])) {
                        $thePostId = $_GET['pId'];
                        echo "<li><a href='/cms/admin/posts.php?source=editPost&pId=$thePostId'>Edit Post </a></li>";
                    }
                }

                ?>



            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>