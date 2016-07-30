<?php
include "../config.php";
include "session.php";
$eventId = $_GET['rowId'];
$eventDate = "";
$eventName = "";
$eventURL = "";
$eventStyleId = "";
$eventABV = "";
$eventIPU = "";
$eventPrice = "";
$eventOnTap = 0;
$newEvent = FALSE;

if ($eventId != null) {
    $result = mysqli_query($db, "SELECT id, date,  name, url FROM event WHERE id = '$eventId'");
    $eventRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($eventRow == NULL) {
        die('I am sorry, we couldn\'t find that event. :(');
    }
    $eventDate = $eventRow['date'];
    $eventName = $eventRow['name'];
    $eventURL = $eventRow['url'];
} else {
    $newEvent = TRUE;
}

if ($_POST['save']) {
    $eventDate = $_POST['date'];
    $eventName = $_POST['name'];
    $eventURL = $_POST['url'];
    $valid = true;

    if ($valid) {
        if ($newEvent) {
            $sql = "INSERT INTO event (date, name, url) VALUES (\"$eventDate\", \"$eventName\", \"$eventURL\")";
        } else {
            $sql = "UPDATE event SET name = \"$eventName\",date = \"$eventDate\",url = ". ($eventURL==""? "NULL" : "\"$eventURL\"") . " WHERE id = $eventId";
        }
        $result = mysqli_query($db, $sql);
        if (mysqli_affected_rows($db) >0){
            header("Location: admin.php");
        }
    }
}
?>
<html>
<!DOCTYPE HTML>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Administrator Portal</title>
</head>
<link rel='stylesheet' type='text/css' href='../stylesheet.css'/>
<body>
<!-- Title -->
<div style="width: 100%;">
    <div class="title">
        <h3>Administrator Portal</h3>
    </div>
</div>
<form action="" method="post">
    <p><label>Date:</label><input type="date" name="date" class="box" value="<?php echo $eventDate; ?>"/><br></p>

    <p><label>Event Name:</label> <input type="text" name="name" class="box" value ="<?php echo $eventName; ?>"/><br/></p>

    <p><label>Facebook URL:</label><input type="text" name="url" class="box" value="<?php echo $eventURL ?>"/><br/></p>

    <?php
    if ($newEvent) {
        echo "<input type='submit' name ='save' value='Create'/>";
    } else {
        echo "<input type='submit' name ='save' value='Update'/>";
    }
    ?><br/></p>
</form>
</body>

</html>
