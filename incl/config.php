<?php
$conn = mysqli_connect("localhost", "root", "", "users");
if(!$conn){
    die("Connection Failed!" . $conn->mysqli_connect_error());
}
?>