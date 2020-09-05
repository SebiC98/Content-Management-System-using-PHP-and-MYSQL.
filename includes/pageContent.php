 <div class="container">

     <div class="row">

         <!-- Blog Entries Column -->
         <div class="col-md-8">
             <?php

                $perPage = 5;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = "";
                }
                if ($page == "" || $page == 1) {
                    $page1 = 0;
                } else {
                    $page1 = ($page * $perPage) - $perPage;
                }
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    $postQueryCount = "SELECT * FROM posts";
                } else {
                    $postQueryCount = "SELECT * FROM posts WHERE postStatus = 'published'";
                    
                }

                $findCount = mysqli_query($connection, $postQueryCount);
                $count = mysqli_num_rows($findCount);
                if ($count < 1) {
                    echo "<h1 class='text-center'>No posts available</h1>";
                } else {
                    $count = ceil($count / $perPage);


                    $query = "SELECT * FROM posts LIMIT $page1, $perPage ";
                    $selectAllPostsQuerry = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($selectAllPostsQuerry)) {
                        $postId = $row['postId'];
                        $postTitle = $row['postTitle'];
                        $postAuthor = $row['postUser'];
                        $postDate = $row['postDate'];
                        $postImage = $row['postImage'];
                        $postContent = substr($row['postContent'], 0, 300);
                        $postStatus = $row['postStatus'];


                ?>
                     <h1 class="page-header">
                         Posts
                     </h1>

                     <!-- First Blog Post -->
                     <h2>
                         <a href="post/<?php echo $postId; ?>"><?php echo $postTitle; ?></a>
                     </h2>
                     <p class="lead">
                         by <a href="../cms/authorPosts/<?php echo $postAuthor; ?>/<?php echo $postId; ?>"><?php echo $postAuthor; ?></a>
                     </p>
                     <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                     <hr>
                     <a href="post.php?pId=<?php echo $postId; ?>">
                         <img class="img-responsive" src="/cms/images/<?php echo $postImage; ?>" alt="">
                     </a>
                     <hr>
                     <p><?php echo $postContent; ?></p>
                     <a class="btn btn-primary" href="../cms/post/<?php echo $postId; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                     <hr>
             <?php
                    }
                }

                ?>
             <!-- Blog Comments -->



             <hr>





         </div>

         <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php"; ?>
     </div>
     <!-- /.row -->

     <hr>

     <ul class="pager">
         <?php
            for ($i = 1; $i <= $count; $i++) {
                if ($i == $page) {
                    echo "<li><a class='activeLink' href='index.php?page={$i}'>{$i}</a></li>";
                } else {
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            } ?>


     </ul>
 </div>