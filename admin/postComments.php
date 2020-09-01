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
                            Welcome to comments
                            <small>Author</small>
                        </h1>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $query = "SELECT * FROM comments WHERE commentPostId =" . mysqli_real_escape_string($connection, $_GET['id']). " ";
                                $selectComments = mysqli_query($connection, $query);
                                confirmQuery($selectComments);

                                while ($row = mysqli_fetch_assoc($selectComments)) {
                                    $commentId = $row['commentId'];
                                    $commentPostId = $row['commentPostId'];
                                    $commentAuthor = $row['commentAuthor'];
                                    $commentEmail = $row['commentEmail'];
                                    $commentContent = $row['commentContent'];
                                    $commentStatus = $row['commentStatus'];
                                    $commentDate = $row['commentDate'];


                                    echo "<tr>";
                                    echo "<td>$commentId</td>";
                                    echo "<td>$commentAuthor</td>";
                                    echo "<td>$commentContent</td>";

                                    // $query = "SELECT * FROM categories WHERE categoryId = $postCategoryId";
                                    // $selectCategoriesId = mysqli_query($connection, $query);
                                    // confirmQuery($selectCategoriesId);
                                    // while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
                                    //     $categoryTitle = $row['categoryTitle'];
                                    // }

                                    echo "<td>$commentEmail</td>";
                                    echo "<td>$commentStatus</td>";


                                    $query = "SELECT * FROM posts where postId = $commentPostId";
                                    $selectPostIdQuery = mysqli_query($connection, $query);
                                    confirmQuery($selectPostIdQuery);
                                    while ($row = mysqli_fetch_assoc($selectPostIdQuery)) {
                                        $postId = $row['postId'];
                                        $postTitle = $row['postTitle'];

                                        echo "<td><a href='../post.php?pId=$postId'>$postTitle</a></td>";
                                    }



                                    echo "<td>$commentDate</td>";

                                    echo "<td><a href='postComments.php?approve=$commentId&id=" . $_GET['id'] ."'>Approve</a></td>";
                                    echo "<td><a href='postComments.php?unapprove=$commentId&id=" . $_GET['id'] ."'>Unapprove</a></td>";
                                    echo "<td><a href='postComments.php?delete=$commentId&id=" . $_GET['id'] ."'>Delete</a></td>";
                                    echo "</tr>";
                                }





                                ?>

                            </tbody>
                        </table>

                        <?php
                        if (isset($_GET['approve'])) {

                            $theCommentId = $_GET['approve'];

                            $query = "UPDATE comments SET commentStatus = 'approved' WHERE commentId = '$theCommentId' ";
                            $approveCommentQuery = mysqli_query($connection, $query);
                            confirmQuery($approveCommentQuery);
                            header("Location: postComments.php?id=" . $_GET['id'] . "");
                        }

                        if (isset($_GET['unapprove'])) {

                            $theCommentId = $_GET['unapprove'];

                            $query = "UPDATE comments SET commentStatus = 'unapproved' WHERE commentId = '$theCommentId' ";
                            $unapproveCommentQuery = mysqli_query($connection, $query);
                            confirmQuery($unapproveCommentQuery);
                            header("Location: postComments.php?id=" . $_GET['id'] . "");
                        }


                        if (isset($_GET['delete'])) {


                            $theCommentId = $_GET['delete'];
                            $query = "DELETE FROM comments WHERE commentId = {$theCommentId} ";
                            $deleteQuery = mysqli_query($connection, $query);
                            confirmQuery($deleteQuery);

                            header("Location: postComments.php?id=" . $_GET['id'] . "");
                        }


                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/adminFooter.php"; ?>