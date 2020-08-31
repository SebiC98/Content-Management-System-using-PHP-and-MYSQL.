 <div class="container">

     <div class="row">

         <!-- Blog Entries Column -->
         <div class="col-md-8">
             <?php
                $query = "SELECT * FROM posts";
                $selectAllPostsQuerry = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($selectAllPostsQuerry)) {
                    $postId = $row['postId'];
                    $postTitle = $row['postTitle'];
                    $postAuthor = $row['postAuthor'];
                    $postDate = $row['postDate'];
                    $postImage = $row['postImage'];
                    $postContent = substr($row['postContent'], 0, 300);
                    $postStatus = $row['postStatus'];

                    if ($postStatus == 'published') {
                ?>
                     <h1 class="page-header">
                         Page Heading
                         <small>Secondary Text</small>
                     </h1>

                     <!-- First Blog Post -->
                     <h2>
                         <a href="post.php?pId=<?php echo $postId; ?>"><?php echo $postTitle; ?></a>
                     </h2>
                     <p class="lead">
                         by <a href="authorPosts.php?author=<?php echo $postAuthor; ?>&pId=<?php echo $postId; ?>"><?php echo $postAuthor; ?></a>
                     </p>
                     <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                     <hr>
                     <a href="post.php?pId=<?php echo $postId; ?>">
                         <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">
                     </a>
                     <hr>
                     <p><?php echo $postContent; ?></p>
                     <a class="btn btn-primary" href="post.php?pId=<?php echo $postId; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                     <hr>
             <?php
                    }
                }
                ?>
             <!-- Blog Comments -->

             <!-- Comments Form -->
             <div class="well">
                 <h4>Leave a Comment:</h4>
                 <form role="form">
                     <div class="form-group">
                         <textarea class="form-control" rows="3"></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                 </form>
             </div>

             <hr>

             <!-- Posted Comments -->

             <!-- Comment -->
             <div class="media">
                 <a class="pull-left" href="#">
                     <img class="media-object" src="http://placehold.it/64x64" alt="">
                 </a>
                 <div class="media-body">
                     <h4 class="media-heading">Start Bootstrap
                         <small>August 25, 2014 at 9:30 PM</small>
                     </h4>
                     Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                 </div>
             </div>

             <!-- Comment -->
             <div class="media">
                 <a class="pull-left" href="#">
                     <img class="media-object" src="http://placehold.it/64x64" alt="">
                 </a>
                 <div class="media-body">
                     <h4 class="media-heading">Start Bootstrap
                         <small>August 25, 2014 at 9:30 PM</small>
                     </h4>
                     Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                     <!-- Nested Comment -->
                     <div class="media">
                         <a class="pull-left" href="#">
                             <img class="media-object" src="http://placehold.it/64x64" alt="">
                         </a>
                         <div class="media-body">
                             <h4 class="media-heading">Nested Start Bootstrap
                                 <small>August 25, 2014 at 9:30 PM</small>
                             </h4>
                             Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                         </div>
                     </div>
                     <!-- End Nested Comment -->
                 </div>
             </div>

         </div>

         <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php"; ?>
     </div>
     <!-- /.row -->

     <hr>
 </div>