<?php
include("../config.php");
include("session.php");

if($_GET['rowId']){
    $id = $_GET['rowId'];
    mysqli_query($db, "DELETE event FROM event WHERE id = $id");
}
header("Location: admin.php")
?>