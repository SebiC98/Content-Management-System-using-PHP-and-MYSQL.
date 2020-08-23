<?php include "includes/adminHeader.php"; ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/adminNavigation.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Post Id</th>
                                    <th>Category Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Image</th>
                                    <th>Content</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $query = "SELECT * FROM posts";
                                $selectPosts = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($selectPosts)) {
                                    $postId = $row['postId'];
                                    $postCategoryId = $row['postCategoryId'];
                                    $postTitle = $row['postTitle'];
                                    $postAuthor = $row['postAuthor'];
                                    $postDate = $row['postDate'];
                                    $postImage = $row['postImage'];
                                    $postContent = $row['postContent'];
                                    $postTags = $row['postTags'];
                                    $postCommentCount = $row['postCommentCount'];
                                    $postStatus = $row['postStatus'];

                                    echo "<tr>";
                                    echo "<td>$postId</td>";
                                    echo "<td>$postCategoryId</td>";
                                    echo "<td>$postTitle</td>";
                                    echo "<td>$postAuthor</td>";
                                    echo "<td>$postDate</td>";
                                    echo "<td><img width='100' src='../images/$postImage' alt='image'></td>";
                                    echo "<td>$postContent</td>";
                                    echo "<td>$postTags</td>";
                                    echo "<td>$postCommentCount</td>";
                                    echo "<td>$postStatus</td>";
                                    echo "</tr>";
                                }





                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/adminFooter.php"; ?>