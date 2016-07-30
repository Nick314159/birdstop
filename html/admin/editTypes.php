<?php
include "../config.php";
include "session.php";
if ($_GET['type'] == "brewery") {
    $type = "Breweries";
    $table = "brewery";
} elseif ($_GET['type'] == "beerStyle") {
    $type = "Beer Styles";
    $table = "beer_style";
}
$foreign_key = $table . "_id";

$result = mysqli_query($db, "SELECT name FROM  $table  ORDER BY name");
while ($row = $result->fetch_assoc()) {
    $tableHTML .= '<td>' . $row['name'] . '</td></tr>';
}

$result = mysqli_query($db, "SELECT id, name FROM  $table");
while ($row = $result->fetch_assoc()) {
    unset($id, $name);
    $id = $row['id'];
    $name = $row['name'];
    $deleteTypeHTML .= "<option value='" . $id . "'";
    $deleteTypeHTML .= ">" . $name . "</option>";
}

if ($_POST['deleteType']) {
    unset($deleteError);
    $id = $_POST[$foreign_key];
    if(isset($id)){
        if (!(mysqli_query($db, "SELECT COUNT(*) FROM  WHERE $foreign_key = $id")) > 0) {
            $result = mysqli_query($db, "DELETE $table FROM $table");
        } else {
            $deleteError = "One or more beers that reference $table. Please remove or change the $table for those beers before removing this $table";
        }
    }
}
if($_POST['addType']){
    $name = $_POST['name'];
    if(isset($name)){
        mysqli_query($db, "INSERT INTO $table (`name`) VALUES ($name)");
    }
}
?>
<html>
<!DOCTYPE HTML>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Edit <?php echo $type ?></title>
</head>
<link rel='stylesheet' type='text/css' href='../stylesheet.css'/>
<body>
<!-- Title -->
<div style="width: 100%;">
    <div class="title">
        <h3>Edit <?php echo $type ?> </h3>
    </div>
</div>

<div style="float:left; width:25%; height: 25%">
    <table align="center" cellpadding="0" cellspacing="0" class="db-table">
        <th>Name</th>
        </tr>
        <?php echo $tableHTML ?>
    </table>
</div>
<div style="float:left; width:75%">
    <div class="margin">
        <form method="post">
            <label>Name: </label> <select name='<?php echo $table . "_id"?>'>
                <?php echo $deleteTypeHTML ?>
            </select>
            <input type="submit" name="deleteType" value="Delete <?php echo $type ?>">
        </form>
        <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $deleteError; ?></div>
        <form method="post">
            <label>Name: </label><input type = "text" name = "name" class = "box"/>
            <input type="submit" name="addType" value="Add <?php echo $type ?>">
        </form>
    </div>

</body>
</html>