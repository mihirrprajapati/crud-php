<?php

$conn = new mysqli("localhost", "root", "", "blog");

if(!$conn){
    die(mysqli_error($conn));
}

?>