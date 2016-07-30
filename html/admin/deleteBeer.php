<?php
include("../config.php");
include("session.php");

if($_GET['rowId']){
    $id = $_GET['rowId'];
    mysqli_query($db, "DELETE beer FROM beer WHERE id = $id");
}
header("Location: admin.php")
?>