<?php include "admin/functions.php" ?>
<div class="container">

     <div class="row">

         <!-- Blog Entries Column -->
         <div class="col-md-8">
             <?php

                if (isset($_GET['category'])) {
                    $thePostCategoryId = $_GET['category'];
                    if (isAdmin($_SESSION['username'])) {
                        $query = "SELECT * FROM posts WHERE postCategoryId = $thePostCategoryId";
                    } else {
                        $query = "SELECT * FROM posts WHERE postCategoryId = $thePostCategoryId AND postStatus = 'published'";

                    }
                  
                    $selectAllPostsQuerry = mysqli_query($connection, $query);
                    if (mysqli_num_rows($selectAllPostsQuerry) < 1) {
                        echo "<h1 class='text-center'>No posts available</h1>";
                    } else {
                        while ($row = mysqli_fetch_assoc($selectAllPostsQuerry)) {
                            $postId = $row['postId'];
                            $postTitle = $row['postTitle'];
                            $postAuthor = $row['postUser'];
                            $postDate = $row['postDate'];
                            $postImage = $row['postImage'];
                            $postContent = substr($row['postContent'], 0, 300);
                ?>
                         <h1 class="page-header">
                             Page Heading
                             <small>Secondary Text</small>
                         </h1>

                         <!-- First Blog Post -->
                         <h2>
                             <a href="../../cms/post/<?php echo $postId; ?>"><?php echo $postTitle; ?></a>
                         </h2>
                         <p class="lead">
                             by <a href="../../cms/authorPosts/<?php echo $postAuthor; ?>/<?php echo $postId; ?>"><?php echo $postAuthor; ?></a>
                         </p>
                         <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                         <hr>
                         <img class="img-responsive" src="/cms/images/<?php echo $postImage; ?>" alt="">
                         <hr>
                         <p><?php echo $postContent; ?></p>
                         <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                         <hr>
             <?php
                        }
                    }
                } else {
                    header("Location:: index.php");
                }
                ?>
             <!-- Blog Comments -->

             <hr>

             <!-- Posted Comments -->

           

           

         </div>

         <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php"; ?>
     </div>
     <!-- /.row -->

     <hr>
 </div>