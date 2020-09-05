
<?php

$connection = mysqli_connect('localhost', 'root', '', 'cms');

if($connection){
    // echo "We are connected!";
}else{
    echo "The connection with the database failed!";
}

?>