<?php



if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulkOptions = $_POST['bulkOptions'];
        switch ($bulkOptions) {
            case 'published':
                $query = "UPDATE posts SET postStatus = '{$bulkOptions}' WHERE postId = {$postValueId}";
                $updateToPublishedStatus = mysqli_query($connection, $query);
                confirmQuery($updateToPublishedStatus);
                break;
            case 'draft':
                $query = "UPDATE posts SET postStatus = '{$bulkOptions}' WHERE postId = {$postValueId}";
                $updateToDraftStatus = mysqli_query($connection, $query);
                confirmQuery($updateToDraftStatus);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE postId = {$postValueId} ";
                $deleteBulk = mysqli_query($connection, $query);
                confirmQuery($deleteBulk);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE postId = {$postValueId} ";
                $selectPostQuery = mysqli_query($connection, $query);
                confirmQuery($selectPostQuery);
                while ($row = mysqli_fetch_array($selectPostQuery)) {
                    $postCategoryId = escape($row['postCategoryId']);
                    $postTitle = escape($row['postTitle']);
                    $postAuthor = escape($row['postAuthor']);
                    $postUser = escape($row['postUser']);
                    $postDate = escape($row['postDate']);
                    $postImage = escape($row['postImage']);
                    $postContent = escape($row['postContent']);
                    $postTags = escape($row['postTags']);
                    $postStatus = escape($row['postStatus']);
                }
                $query = "INSERT INTO posts(postCategoryId, postTitle, postAuthor, postUser, postDate, postImage, postContent, postTags, postStatus) VALUES({$postCategoryId},'{$postTitle}','{$postAuthor}', '{$postUser}',now(),'{$postImage}','{$postContent}','{$postTags}','{$postStatus}') ";

                $createPostQuery = mysqli_query($connection, $query);

                confirmQuery($createPostQuery);
                break;
            case 'reset':
                $query = "UPDATE posts SET postViewsCount = 0 WHERE postId = {$postValueId} ";
                $resetBulk = mysqli_query($connection, $query);
                confirmQuery($resetBulk);
                break;
        }
    }
}

?>
<form action="" method='post'>
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" style="padding: 0px;" class="col-xs-4">
            <select class="form-control" name="bulkOptions" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                <option value="reset">Reset</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=addPost">Add New </a>
        </div>

        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Category</th>
                <th>Title</th>
                <th>User</th>
                <th>Date</th>
                <th>Image</th>
                <th>Content</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Status</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>

        <tbody>
            <?php

            // $query = "SELECT * FROM posts ORDER BY postId DESC ";
            $query = "SELECT posts.postId, posts.postAuthor, posts.postUser, posts.postTitle, posts.postCategoryId, posts.postStatus, posts.postImage, ";
            $query .= "posts.postTags, posts.postCommentCount, posts.postDate, posts.postViewsCount, posts.postContent, categories.categoryId, categories.categoryTitle ";
            $query .= "FROM posts ";
            $query .= "LEFT JOIN categories ON posts.postCategoryId = categories.categoryId ORDER BY posts.postId DESC ";
            $selectPosts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($selectPosts)) {
                $postId = $row['postId'];
                $postCategoryId = $row['postCategoryId'];
                $postTitle = $row['postTitle'];
                $postAuthor = $row['postAuthor'];
                $postUser = $row['postUser'];
                $postDate = $row['postDate'];
                $postImage = $row['postImage'];
                $postContent = substr($row['postContent'], 0, 100);
                $postTags = $row['postTags'];
                $postCommentCount = $row['postCommentCount'];
                $postStatus = $row['postStatus'];
                $postViewsCount = $row['postViewsCount'];
                $theCategoryTitle = $row['categoryTitle'];
                $theCategoryId = $row['categoryId'];


                echo "<tr>";
            ?>
                <td><input class='checkBoxes' id='selectAllBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $postId; ?>'></td>
                <?php

                echo "<td>$postId</td>";
                // $query = "SELECT * FROM categories WHERE categoryId = $postCategoryId";
                // $selectCategoriesId = mysqli_query($connection, $query);
                // confirmQuery($selectCategoriesId);
                // while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
                //     $categoryTitle = $row['categoryTitle'];
                // }

                echo "<td>$theCategoryTitle</td>";

                echo "<td>$postTitle</td>";

                if (!empty($postAuthor)) {
                    echo "<td>$postAuthor</td>";
                } elseif (!empty($postUser)) {
                    echo "<td>$postUser</td>";
                }


                echo "<td>$postDate</td>";
                echo "<td><img width='100' src='../images/$postImage' alt='image'></td>";
                echo "<td>$postContent</td>";
                echo "<td>$postTags</td>";

                $query = "SELECT * FROM comments WHERE commentPostId = $postId";
                $sendCommentQuery = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($sendCommentQuery);
                if (!empty($row['commentId'])) {
                    $commentId = $row['commentId'];
                    $countComments = mysqli_num_rows($sendCommentQuery);
                    echo "<td><a href='postComments.php?id=$postId'>$countComments</td>";
                } else {

                    echo "<td><a href='#'>0</td>";
                }


                echo "<td>$postStatus</td>";
                echo "<td><a class='btn btn-primary' href='../post.php?pId={$postId}'>View</a></td>";
                echo "<td><a class='btn btn-info' href='posts.php?source=editPost&pId={$postId}'>Edit</a></td>";
                ?>
                <form action="post">
                    <input type="hidden" name="postId" value="<?php echo $postId; ?>">
                    <?php
                    echo '<td><input type="submit" name="delete" value="Delete" class="btn btn-danger"></td>';
                    ?>
                </form>


            <?php

               

                //echo "<td><a rel='$postId' href='javascript: void(0)' class='deleteLink'>Delete</a></td>";

                // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$postId}'>Delete</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset?'); \" href='posts.php?reset={$postId}'>$postViewsCount</a></td>";
                echo "</tr>";
            }





            ?>

        </tbody>
    </table>
</form>
<?php

if (isset($_POST['delete'])) {

    $thePostId = escape($_POST['postId']);

    $query = "DELETE FROM posts WHERE postId = {$thePostId} ";
    $deleteQuery = mysqli_query($connection, $query);

    confirmQuery($deleteQuery);
    header("Location: posts.php");
}

if (isset($_GET['reset'])) {

    $thePostId = $_GET['reset'];

    $query = "UPDATE posts SET postViewsCount = 0 WHERE postId = {$thePostId} ";
    $resetQuery = mysqli_query($connection, $query);

    confirmQuery($resetQuery);
    header("Location: posts.php");
}
// include("deleteModal.php");
?>

<!-- <script>
    $(document).ready(function() {
        $(".deleteLink").on('click', function() {
            var id = $(this).attr("rel");
            var deleteUrl = "posts.php?delete=" + id + " ";

            $(".modalDeleteLink").attr("href", deleteUrl);

            $("#myModal").modal('show');
        })


    });
</script> -->