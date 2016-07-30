<?php
/* connect to the db */
include('../config.php');
/* Find current date */
$sql = "SELECT CURDATE()";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$dateCurrent = $row['CURDATE()'];
/* Find all events within two week window */
$sql = "SELECT id, date, name FROM events WHERE date >= '$dateCurrent'";
$result = mysqli_query($db,$sql);
if(mysqli_num_rows($result)) {
  /* create table */
  $table .= '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
  $table .= '<tr><th>Date</th><th>Event</th></tr>';
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    $table .= '<tr>';
    /* Date */
    $table .= '<td>' . $row['date'] . '</td>';
    /* Event */
    $table .= '<td>' . $row['name'] . '</td>';
    $table .= '</tr>';
  }
  $table .= '</table>';
}
?>
<html>
<!DOCTYPE HTML>
<head>
  <title>Events</title>
</head>
<link rel='stylesheet' type='text/css' href='../stylesheet.css'>
<body>
<!-- Navigation Bar -->
<div style="width: 100%;">
<div class="navigation-bar">
  <ul>
    <li><a href="../about.html">ABOUT</a></li>
    <li><a href="../kitchen.html">KITCHEN<a/></li>
    <li><a href="../main.html"><img class="logo" src="../pictures/logo.png"></a></li>
    <li><a href="../events/events.php">EVENTS</a></li>
    <li><a href="../brews/brews.php">BREWS</a></li>
  </ul>
</div>
</div>
<!-- Table -->
<div style="width: 100%">
  <?php echo $table; ?>
</div>
</body>

</html>
