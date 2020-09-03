 <div class="container">

     <div class="row">

         <!-- Blog Entries Column -->
         <div class="col-md-8">
             <?php

                if (isset($_GET['pId'])) {
                    $thePostId = $_GET['pId'];
                    $thePostAuthor = $_GET['author'];

                    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                        $query = "SELECT * FROM posts WHERE postUser = '{$thePostAuthor}' ";
                    } else {
                        $query = "SELECT * FROM posts WHERE postUser = '{$thePostAuthor}' AND postStatus = 'published' ";
                    }
                   
                    $selectAllPostsQuerry = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($selectAllPostsQuerry)) {
                        $postTitle = $row['postTitle'];
                        $postAuthor = $row['postUser'];
                        $postDate = $row['postDate'];
                        $postImage = $row['postImage'];
                        $postContent = $row['postContent'];
                ?>
                     <h1 class="page-header">
                         Page Heading
                         <small>Secondary Text</small>
                     </h1>

                     <!-- First Blog Post -->
                     <h2>
                         <a href="#"><?php echo $postTitle; ?></a>
                     </h2>
                     <p class="lead">
                         by <a href="authorPosts.php?author=<?php echo $postAuthor; ?>&pId=<?php echo $postId; ?>"><?php echo $postAuthor; ?></a>
                     </p>
                     <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                     <hr>
                     <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">
                     <hr>
                     <p><?php echo $postContent; ?></p>
                     <hr>
             <?php
                    }
                }
                ?>
             <!-- Blog Comments -->

             <?php


                if (isset($_POST['createComment'])) {
                    $thePostId = $_GET['pId'];
                    $commentAuthor = $_POST['commentAuthor'];
                    $commentEmail = $_POST['commentEmail'];
                    $commentContent = $_POST['commentContent'];
                    if (!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent)) {

                        $query = "INSERT INTO comments (commentPostId, commentAuthor, commentEmail, commentContent, commentStatus, commentDate) ";
                        $query .= "VALUES ($thePostId,'{$commentAuthor}','{$commentEmail}', '{$commentContent}', 'unapproved', now())";

                        $createCommentQuery = mysqli_query($connection, $query);
                        if (!$createCommentQuery) {
                            die("QUERY FAILED " . mysqli_error($connection));
                        }

                        if (isset($_POST['createComment'])) {
                            $query = "UPDATE posts SET postCommentCount = postCommentCount + 1 ";
                            $query .= "WHERE postId = $thePostId ";
                        }
                        $updateCommentCountQuery = mysqli_query($connection, $query);

                        if (!$updateCommentCountQuery) {
                            die("QUERY FAILED " . mysqli_error($connection));
                        }
                    } else {
                        echo "<script>alert('Fields cannot be empty!')</script>";
                    }
                }

                ?>
         </div>

         <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php"; ?>
     </div>
     <!-- /.row -->

     <hr>
 </div>