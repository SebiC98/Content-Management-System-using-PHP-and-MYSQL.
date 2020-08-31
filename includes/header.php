<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <?php

    if (isset($_GET['category'])) {
        $thePostCategoryId = $_GET['category'];

        $query = "SELECT * FROM categories WHERE categoryId = $thePostCategoryId";
        $selectAllCategoriesQuerry = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($selectAllCategoriesQuerry);
        $categoryTitle = $row['categoryTitle'];
    ?>
        <title><?php echo $categoryTitle; ?></title>
        <?php }
    if (isset($_GET['pId'])) {
        if (!isset($_GET['author'])) {
            $thePostId = $_GET['pId'];
            $query = "SELECT * FROM posts WHERE postId = $thePostId ";
            $selectAllPostsQuerry = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($selectAllPostsQuerry);
            $postTitle = $row['postTitle'];
            $postAuthor = $row['postAuthor'];
        ?>
            <title><?php echo $postTitle; ?></title>
        <?php } else {
            $thePostAuthor = $_GET['author'];?>
            <title>Posts from <?php echo $thePostAuthor; ?></title>
        <?php }
    } else { ?>
        <title>Home</title>
    <?php } ?>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>