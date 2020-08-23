<form action="" method="post">
    <div class="form-group">
        <label for="catTitle">Update Category</label>

        <?php

        if (isset($_GET['edit'])) {
            $categoryId = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE categoryId = $categoryId";
            $selectCategoriesId = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
                $categoryId = $row['categoryId'];
                $categoryTitle = $row['categoryTitle'];
        ?>
                <input value="<?php if (isset($categoryTitle)) {
                                    echo $categoryTitle;
                                } ?>" type="text" class="form-control" name="categoryTitle">

        <?php }
        } ?>
        <?php

        //UPDATE QUERY

        if (isset($_POST['updateCategory'])) {

            $theCategoryTitle = $_POST['categoryTitle'];
            $updateQuery = "UPDATE categories SET categoryTitle = '{$theCategoryTitle}' WHERE categoryId = {$categoryId}";
            $updateQuery = mysqli_query($connection, $updateQuery);

            if (!$updateQuery) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="updateCategory" value="Update Category">
    </div>
</form>