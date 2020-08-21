 <div class="container">

     <div class="row">

         <!-- Blog Entries Column -->
         <div class="col-md-8">
             <?php
                $query = "SELECT * FROM posts";
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
                     by <a href="index.php"><?php echo $postAuthor; ?></a>
                 </p>
                 <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                 <hr>
                 <img class="img-responsive" src="images/<?php echo $postImage;?>" alt="">
                 <hr>
                 <p><?php echo $postContent; ?></p>
                 <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                 <hr>
             <?php
                }
                ?>
         </div>

         <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php"; ?>
     </div>
     <!-- /.row -->

     <hr>
 </div>