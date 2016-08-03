<?php
include_once "../config.php";
include "session.php";
$result = mysqli_query($db, "SELECT b.id, b.name, br.name as brewery, b.origin, bs.name as beer_style, b.ABV, b.IBU, b.price, b.on_tap FROM beer b JOIN brewery br on b.brewery_id = br.id JOIN beer_style bs ON b.beer_style_id = bs.id ORDER BY b.on_tap DESC, b.name");
$brewsTable .= '<table align="center" cellpadding="0" cellspacing="0" class="db-table"><tr><th></th><th>Name</th> <th>Brewery</th><th>Origin</th><th>Beer Style</th><th>ABV %</th><th>IBU</th> <th>Price</th><th>On Tap</th><th></th></tr>';
while ($row = mysqli_fetch_array($result)) {
    $brewsTable .= "<td><button type='button' onClick=\"Javascript:window.location.href = 'editBeer.php?rowId=" . $row['id'] . "';\">Edit</button></td>";
    $brewsTable .= '<td>' . $row['name'] . '</td>';
    $brewsTable .= '<td>' . $row['brewery'] . '</td>';
    $brewsTable .= '<td>' . $row['origin'] . '</td>';
    $brewsTable .= '<td>' . $row['beer_style'] . '</td>';
    $brewsTable .= '<td>' . $row['ABV'] . '</td>';
    $brewsTable .= '<td>' . $row['IBU'] . '</td>';
    $brewsTable .= '<td>' . $row['price'] . '</td>';
    $brewsTable .= '<td> <input name="on_tap" type="checkbox"  disabled="disabled"';
    if ($row['on_tap'] == 1) {
        $brewsTable .= 'value="1" checked>';
    } else {
        $brewsTable .= 'value="0">';
    }
    $brewsTable .= "<td><form method='post'> <button type='button' onClick=\"Javascript:window.location.href = 'deleteBeer.php?rowId=" . $row['id'] . "';\">Delete</button></form></td>";
    $brewsTable .= '</tr>';
}
$brewsTable .= '</table>';

$sql = "SELECT id, date, name, url FROM event WHERE date >= (SELECT CURDATE()) ORDER BY date";
$result = mysqli_query($db, $sql);
    /* create table */
    $eventsTable .= '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
    $eventsTable .= '<tr><th></th><th>Date</th><th>Event</th><th></th></tr>';
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $eventsTable .= '<tr>';
        $eventsTable .= "<td><button type='button' onClick=\"Javascript:window.location.href = 'editEvent.php?rowId=" . $row['id'] . "';\">Edit</button></td>";
        /* Date */
        $eventsTable .= '<td>' . $row['date'] . '</td>';
        /* Event */
        $eventsTable .= '<td><a href="' . $row['url'] . '">' . $row['name'] . '<a/></td>';
        $eventsTable .= "<td><button type='button' onClick=\"Javascript:window.location.href = 'deleteEvent.php?rowId=" . $row['id'] . "';\">Delete</button></td>";
        $eventsTable .= '</tr>';
    }
    $eventsTable .= '</table>';

//Buttons
if ($_POST['beerNew']) {
    header("location: editBeer.php");
}
if ($_POST['editBreweries']) {
    header("location: editTypes.php?type=brewery");
}
if ($_POST['editBeerStyles']) {
    header("location: editTypes.php?type=beerStyle");
}
if ($_POST['eventNew']) {
    header("location: editEvent.php");
}
if ($_POST['exit']) {
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
  }
  header("location: login.php");
}
?>
<html>
<!DOCTYPE HTML>
<head>
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
<!-- Exit -->
<div style="width: 100%">
  <div class="header">
    <form method="post">
      <input type="submit" name="exit" value="Exit">
    </form>
  </div>
</div>
<!-- Tables -->
<div style="width: 100%">
    <div class="header">
        <hr class="hrstyle-one" width="50%">
        <form method="post">
          <input type="submit" name="beerNew" value="Add New Beer">
          <input type="submit" name="editBreweries" value="Edit Breweries"><br>
          <input type="submit" name="editBeerStyles" value="Edit Beer Styles">
        </form>
        <hr class="hrstyle-one" width="50%">
    </div>
    <?php echo $brewsTable; ?>
    <div class="header">
      <hr class="hrstyle-one" width="50%">
      <form method="post">
        <input type="submit" name="eventNew" value="Add New Event"><br>
      </form>
      <hr class="hrstyle-one" width="50%">
    </div>
    <?php echo $eventsTable; ?>
</div>
</body>

</html>


