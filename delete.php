<?php

include('connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    echo $id;
    $sql = "DELETE FROM `blog` WHERE id=$id" ;

    $res = mysqli_query($conn, $sql);

    if($res){
        header("Location: display.php");
    }else{
        die(mysqli_error($res));
    }
}

?>