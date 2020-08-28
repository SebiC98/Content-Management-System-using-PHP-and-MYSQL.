<?php include "includes/adminHeader.php"; ?>

<?php
if (!isset($_SESSION['role'])) {

    header("Location: ../index.php");
}
?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/adminNavigation.php"; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin,
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $query = "SELECT * FROM posts";
                                    $selectAllPosts = mysqli_query($connection, $query);
                                    confirmQuery($selectAllPosts);
                                    $postCounts = mysqli_num_rows($selectAllPosts);
                                    echo "<div class='huge'>{$postCounts}</div>";
                                    ?>

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $query = "SELECT * FROM comments";
                                    $selectAllComments = mysqli_query($connection, $query);
                                    confirmQuery($selectAllComments);
                                    $commentCounts = mysqli_num_rows($selectAllComments);
                                    echo "<div class='huge'>{$commentCounts}</div>";
                                    ?>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $query = "SELECT * FROM users";
                                    $selectAllUsers = mysqli_query($connection, $query);
                                    confirmQuery($selectAllUsers);
                                    $countUsers = mysqli_num_rows($selectAllUsers);
                                    echo "<div class='huge'>{$countUsers}</div>";
                                    ?>

                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $query = "SELECT * FROM categories";
                                    $selectAllCategories = mysqli_query($connection, $query);
                                    confirmQuery($selectAllCategories);
                                    $countCategories = mysqli_num_rows($selectAllCategories);
                                    echo "<div class='huge'>{$countCategories}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php

            $query = "SELECT * FROM posts WHERE postStatus = 'published'";
            $selectAllPublishedPosts = mysqli_query($connection, $query);
            confirmQuery($selectAllPublishedPosts);
            $postPublishedCounts = mysqli_num_rows($selectAllPublishedPosts);

            $query = "SELECT * FROM posts WHERE postStatus = 'draft'";
            $selectAllDraftPosts = mysqli_query($connection, $query);
            confirmQuery($selectAllDraftPosts);
            $postDraftCounts = mysqli_num_rows($selectAllDraftPosts);

            $query = "SELECT * FROM comments WHERE commentStatus = 'unapproved'";
            $selectAllUnapproveComments = mysqli_query($connection, $query);
            confirmQuery($selectAllUnapproveComments);
            $commentsUnapproveCounts = mysqli_num_rows($selectAllUnapproveComments);

            $query = "SELECT * FROM users WHERE userRole = 'subscriber'";
            $selectAllSubscriberUsers = mysqli_query($connection, $query);
            confirmQuery($selectAllSubscriberUsers);
            $usersSubscriberCounts = mysqli_num_rows($selectAllSubscriberUsers);




            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php

                            $elementText = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscribers', 'Categories'];
                            $elementCount = [$postCounts, $postPublishedCounts, $postDraftCounts, $commentCounts, $commentsUnapproveCounts, $countUsers, $usersSubscriberCounts, $countCategories];
                            for ($i = 0; $i < 8; $i++) {

                                echo "['{$elementText[$i]}'" . "," . "{$elementCount[$i]}],";
                            }


                            ?>

                            // ['Posts', 1000],
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',

                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: auto; height: 500px;"></div>



            </div>




        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/adminFooter.php"; ?>