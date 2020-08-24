<?php
function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED".mysqli_error($result));
    }
}

function insertCategories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $categoryTitle = $_POST['catTitle'];
        if ($categoryTitle == "" || empty($categoryTitle)) {
            echo "This field should not be empty!";
        } else {
            $query = "INSERT INTO categories(categoryTitle) ";
            $query .= "VALUE('{$categoryTitle}')";

            $createCategoryQuery = mysqli_query($connection, $query);

            if (!$createCategoryQuery) {
                die("QUERY FAILED!" . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $selectCategories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selectCategories)) {
        $categoryId = $row['categoryId'];
        $categoryTitle = $row['categoryTitle'];
        echo "<tr>";
        echo "<td>{$categoryId}</td>";
        echo "<td>{$categoryTitle}</td>";
        echo "<td><a href='categories.php?delete={$categoryId}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$categoryId}'>Edit</a></td>";

        echo "</tr>";
    }
}

function deleteCategories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $theCategoryId = $_GET['delete'];
        $query = "DELETE FROM categories WHERE categoryId = {$theCategoryId}";
        $deleteQuery = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function updateAndInclude()
{
    if (isset($_GET['edit'])) {

        $categoryId = $_GET['edit'];
        include "includes/updateCategories.php";
    }
}
