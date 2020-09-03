<?php

if (isset($_GET['pId'])) {
    $theGetPostId = $_GET['pId'];
}

$query = "SELECT * FROM posts WHERE postId = $theGetPostId";
$selectPostsById = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($selectPostsById)) {
    $postId = $row['postId'];
    $postCategoryId = $row['postCategoryId'];
    $postTitle = $row['postTitle'];
    $postUser = $row['postUser'];
    $postDate = $row['postDate'];
    $postImage = $row['postImage'];
    $postContent = $row['postContent'];
    $postTags = $row['postTags'];
    $postCommentCount = $row['postCommentCount'];
    $postStatus = $row['postStatus'];
}

if (isset($_POST['updatePost'])) {
    //THESE ARE THE NAMES FROM name of the option
    $postUser = $_POST['postUser']; //author from options
    $postTitle = $_POST['title']; //title from option 
    $postCategoryId = $_POST['postCategory']; //postCategory from the SELECT line 63
    $postStatus = $_POST['postStatus'];
    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];
    $postContent = $_POST['postContent'];
    $postTags = $_POST['postTags'];

    move_uploaded_file($postImageTemp, "../images/$postImage");


    if (empty($postImage)) {
        $query = "SELECT * FROM posts WHERE postId = $theGetPostId ";
        $selectImage = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($selectImage)) {
            $postImage = $row['postImage'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "postTitle = '{$postTitle}', ";
    $query .= "postCategoryId = '{$postCategoryId}', ";
    $query .= "postDate = now(), ";
    $query .= "postUser = '{$postUser}', ";
    $query .= "postStatus = '{$postStatus}', ";
    $query .= "postTags = '{$postTags}', ";
    $query .= "postContent = '{$postContent}', ";
    $query .= "postImage = '{$postImage}' ";
    $query .= "WHERE postId = {$theGetPostId} ";

    $updatePostQuery = mysqli_query($connection, $query);

    confirmQuery($updatePostQuery);
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?pId={$theGetPostId}'>View Post</a> or <a href='posts.php'>Edit More Posts</a> </p>";
}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $postTitle; ?>" type="text" class="form-control" name="title">
    </div>
    <label for="categories">Categories</label>
    <select name="postCategory" id="postCategory">

        <?php
        $query = "SELECT * FROM categories";
        $selectCategories = mysqli_query($connection, $query);

        confirmQuery($selectCategories);

        while ($row = mysqli_fetch_assoc($selectCategories)) {
            $categoryId = $row['categoryId'];
            $categoryTitle = $row['categoryTitle'];
            if ($categoryId == $postCategoryId) {
                echo "<option selected value='{$categoryId}'>{$categoryTitle}</option>";
            } else {
                echo "<option value='{$categoryId}'>{$categoryTitle}</option>";
            }
        }


        ?>


    </select>
    <!-- <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $postUser; ?>" type="text" class="form-control" name="author">
    </div> -->
    <div class="form-group">
        <label for="title">Users</label>
        <select name="postUser" id="postUser">
            <?php echo "<option value='{$postUser}'>{$postUser}</option>"; ?>

            <?php
            $query = "SELECT * FROM users";
            $selectUsers = mysqli_query($connection, $query);

            confirmQuery($selectUsers);

            while ($row = mysqli_fetch_assoc($selectUsers)) {
                $userId = $row['userId'];
                $userName = $row['userName'];
                if ($userName == $postUser) {
                    echo "<option selected value='{$userName}'>{$userName}</option>";
                } else {
                    echo "<option value='{$userName}'>{$userName}</option>";
                }
            }


            ?>
        </select>
    </div>

    <div class="form-group">
        <select name="postStatus" id="">
            <option value='<?php echo $postStatus; ?>'><?php echo $postStatus; ?></option>
            <?php if ($postStatus === 'published') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='published'>Publish</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $postImage; ?>" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="postTags">Post Tags</label>
        <input value="<?php echo $postTags; ?>" type="text" class="form-control" name="postTags">
    </div>
    <div class="form-group">
        <label for="postContent">Post Content</label>
        <textarea class="form-control" name="postContent" id="body" cols="30" rows="10"><?php echo $postContent; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="updatePost" value="Update Post">
    </div>
</form>