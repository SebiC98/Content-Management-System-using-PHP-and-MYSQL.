 <div class="container">

     <div class="row">

         <!-- Blog Entries Column -->
         <div class="col-md-8">
             <?php

                if (isset($_GET['pId'])) {
                    $thePostId = $_GET['pId'];
                    $viewQuery = "UPDATE posts SET postViewsCount = postViewsCount + 1 WHERE postId = $thePostId";
                    $sendQuery = mysqli_query($connection, $viewQuery);
                    if (!$sendQuery) {
                        die("Query Failed" . mysqli_error($sendQuery));
                    }


                    $query = "SELECT * FROM posts WHERE postId = $thePostId ";
                    $selectAllPostsQuerry = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($selectAllPostsQuerry)) {
                        $postTitle = $row['postTitle'];
                        $postAuthor = $row['postAuthor'];
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
                } else {
                    header("Location: index.php");
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

                        // if (isset($_POST['createComment'])) {
                        //     $query = "UPDATE posts SET postCommentCount = postCommentCount + 1 ";
                        //     $query .= "WHERE postId = $thePostId ";
                        // }
                        // $updateCommentCountQuery = mysqli_query($connection, $query);

                        // if (!$updateCommentCountQuery) {
                        //     die("QUERY FAILED " . mysqli_error($connection));
                        // }
                    } else {
                        echo "<script>alert('Fields cannot be empty!')</script>";
                    }
                }

                ?>



             <!-- Comments Form -->
             <div class="well">
                 <h4>Leave a Comment:</h4>
                 <form action="" method="post" role="form">

                     <div class="form-group">
                         <label for="Author">Author</label>
                         <input type="text" class="form-control" name="commentAuthor">
                     </div>
                     <div class="form-group">
                         <label for="Email">Email</label>
                         <input type="email" class="form-control" name="commentEmail">
                     </div>
                     <div class="form-group">
                         <label for="comment">Your Comment</label>
                         <textarea name="commentContent" class="form-control" rows="3"></textarea>
                     </div>
                     <button type="submit" name="createComment" class="btn btn-primary">Submit</button>
                 </form>
             </div>

             <hr>

             <!-- Posted Comments -->
             <?php

                $query = "SELECT * FROM comments WHERE commentPostId = {$thePostId} ";
                $query .= "AND commentStatus = 'approved' ";
                $query .= "ORDER BY commentId DESC ";

                $selectCommentQuery = mysqli_query($connection, $query);


                if (!$selectCommentQuery) {
                    die('Invalid query: ' . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_array($selectCommentQuery)) {
                    $commentDate = $row['commentDate'];
                    $commentContent = $row['commentContent'];
                    $commentAuthor = $row['commentAuthor'];
                ?>
                 <!-- Comment -->
                 <div class="media">
                     <a class="pull-left" href="#">
                         <img class="media-object" src="http://placehold.it/64x64" alt="">
                     </a>
                     <div class="media-body">
                         <h4 class="media-heading"><?php echo $commentAuthor; ?>
                             <small><?php echo $commentDate; ?></small>
                         </h4>
                         <?php echo $commentContent; ?>
                     </div>
                 </div>
             <?php } ?>

         </div>

         <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php"; ?>
     </div>
     <!-- /.row -->

     <hr>
 </div>