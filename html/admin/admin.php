<?php
include_once "../config.php";
include "session.php";
$result = mysqli_query($db, "SELECT b.id, b.name, br.name as brewery, b.origin, bs.name as beer_style, b.ABV, b.IBU, b.price, b.on_tap FROM beer b JOIN brewery br on b.brewery_id = br.id JOIN beer_style bs ON b.beer_style_id = bs.id ORDER BY b.on_tap DESC, b.name");
$brewsTable .= '<table align="center" cellpadding="0" cellspacing="0" class="db-table"><tr><th></th><th>Name</th> <th>Brewery</th><th>Origin</th><th>Beer Style</th><th>ABV</th><th>IBV</th> <th>Price</th><th>On Tap</th><th></th></tr>';
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
    $brewsTable .= '</td></tr>';
}
$brewsTable .= '</table>';

$sql = "SELECT date, name, url FROM events WHERE date >= (SELECT CURDATE()) ORDER BY date";
$result = mysqli_query($db,$sql);
if(mysqli_num_rows($result)) {
    /* create table */
    $eventsTable .= '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
    $eventsTable .= '<tr><th>Event</th><th>Date</th><th>Event</th><th></th></tr>';
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $eventsTable .= '<tr>';
        /* Date */
        $eventsTable .= '<td>' . $row['date'] . '</td>';
        /* Event */
        $eventsTable .= '<td><a href="'.$row['url'].'">' . $row['name'] . '<a/></td>';
        $eventsTable .= '</tr>';
    }
    $eventsTable .= '</table>';
}
//New Beer Button
if ($_POST['beerNew']) {
    header("location: editBeer.php");
}
if ($_POST['editBreweries']) {
    header("location: editTypes.php?type=brewery");
}
if ($_POST['editBeerStyles']) {
    header("location: editTypes.php?type=beerStyle");
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
<!-- Table -->
<div style="width: 100%">
    <div class="margin">
        <form method="post">
            <input type="submit" name="beerNew" value="Add New Beer">
            <input type="submit" name="editBreweries" value="Edit Breweries">
            <input type="submit" name="editBeerStyles" value="Edit Beer Styles"><br>
        </form>
        <input type="button" name="exit" value="Exit" onClick="window.location='../main.html';"/>

    </div>
    <?php echo $brewsTable; ?>
    <?php echo $eventsTable; ?>
</div>
</body>

</html>
