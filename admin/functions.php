

<?php


function usersOnline()
{
    if (isset($_GET['onlineusers'])) {


        global $connection;

        if (!$connection) {

            session_start();

            include("../includes/db.php");
            $session = session_id();
            $time = time();
            $timeOutInSeconds = 5;
            $timeOut = $time - $timeOutInSeconds;

            $query = "SELECT * FROM usersonline WHERE session = '$session'";
            $sendQuery = mysqli_query($connection, $query);
            confirmQuery($sendQuery);

            $count = mysqli_num_rows($sendQuery);
            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO usersonline(session, time) VALUES ('$session','$time')");
            } else {
                mysqli_query($connection, "UPDATE usersonline SET time ='$time WHERE session ='$session'");
            }
            $usersOnlineQuery =  mysqli_query($connection, "SELECT * FROM usersonline WHERE time > '$timeOut'");
            echo $countUsers = mysqli_num_rows($usersOnlineQuery);
        }
    }
}

usersOnline();

function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
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
