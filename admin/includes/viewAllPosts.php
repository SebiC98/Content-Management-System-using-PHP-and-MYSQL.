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
                <th>Author</th>
                <th>Date</th>
                <th>Image</th>
                <th>Content</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Status</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
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
                $postContent = substr($row['postContent'], 0, 100);
                $postTags = $row['postTags'];
                $postCommentCount = $row['postCommentCount'];
                $postStatus = $row['postStatus'];

                echo "<tr>";
            ?>
                <td><input class='checkBoxes' id='selectAllBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $postId; ?>'></td>
            <?php

                echo "<td>$postId</td>";
                $query = "SELECT * FROM categories WHERE categoryId = $postCategoryId";
                $selectCategoriesId = mysqli_query($connection, $query);
                confirmQuery($selectCategoriesId);
                while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
                    $categoryTitle = $row['categoryTitle'];
                }

                echo "<td>{$categoryTitle}</td>";

                echo "<td>$postTitle</td>";
                echo "<td>$postAuthor</td>";
                echo "<td>$postDate</td>";
                echo "<td><img width='100' src='../images/$postImage' alt='image'></td>";
                echo "<td>$postContent</td>";
                echo "<td>$postTags</td>";
                echo "<td>$postCommentCount</td>";
                echo "<td>$postStatus</td>";
                echo "<td><a href='../post.php?pId={$postId}'>View</a></td>";
                echo "<td><a href='posts.php?source=editPost&pId={$postId}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$postId}'>Delete</a></td>";
                echo "</tr>";
            }





            ?>

        </tbody>
    </table>
</form>
<?php

if (isset($_GET['delete'])) {

    $thePostId = $_GET['delete'];

    $query = "DELETE FROM posts WHERE postId = {$thePostId} ";
    $deleteQuery = mysqli_query($connection, $query);

    confirmQuery($deleteQuery);
    header("Location: posts.php");
}


?>