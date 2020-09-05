

<?php
function redirect($location)
{
    return header("Location: " . $location);
}
function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}


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

function recordCount($tableName)
{
    global $connection;
    $query = "SELECT * FROM " . $tableName;
    $selectAllPosts = mysqli_query($connection, $query);
    confirmQuery($selectAllPosts);
    $result = mysqli_num_rows($selectAllPosts);
    return $result;
}

function checkStatus($table, $column, $status)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_num_rows($result);
}

function checkUserRole($table, $column, $role)
{
    global $connection;
    $query = "SELECT * FROM users WHERE userRole = '$role'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_num_rows($result);
}

function isAdmin($username)
{
    global $connection;
    $query = "SELECT userRole FROM users WHERE userName = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row = mysqli_fetch_array($result);
    if ($row['userRole'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

function usernameExists($username)
{
    global $connection;
    $query = "SELECT userName FROM users WHERE userName = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function emailExists($email)
{
    global $connection;
    $query = "SELECT userEmail FROM users WHERE userEmail = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function registerUser($username, $email, $password)
{
    global $connection;

    $username =  mysqli_real_escape_string($connection, $username);
    $email =  mysqli_real_escape_string($connection, $email);
    $password =  mysqli_real_escape_string($connection, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users(userName, userPassword, userEmail, userRole) ";
    $query .= "VALUES('{$username}','{$password}','{$email}','subscriber') ";

    $registerUserQuery = mysqli_query($connection, $query);

    confirmQuery($registerUserQuery);
}
function loginUser($username, $password)
{
    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE userName = '{$username}' ";
    $selectUserQuery = mysqli_query($connection, $query);
    if (!$selectUserQuery) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($selectUserQuery)) {
        $dbUserId = $row['userId'];
        $dbUserName = $row['userName'];
        $dbUserPassword = $row['userPassword'];
        $dbUserFirstname = $row['userFirstname'];
        $dbUserLastname = $row['userLastname'];
        $dbUserRole = $row['userRole'];
    }


    if (password_verify($password, $dbUserPassword)) {

        $_SESSION['username'] = $dbUserName;
        $_SESSION['firstname'] = $dbUserFirstname;
        $_SESSION['lastname'] = $dbUserLastname;
        $_SESSION['role'] = $dbUserRole;

        redirect("../admin/admin.php");
        //    ("Location: ../admin/admin.php");
    } else {
        redirect("../index.php");
        // header("Location: ../index.php");
    }
}
