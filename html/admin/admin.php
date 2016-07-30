<?php
include_once "../config.php";
include "session.php";
$result = mysqli_query($db, "SELECT b.id, b.name, br.name as brewery, b.origin, bs.name as beer_style, b.ABV, b.IBU, b.price, b.on_tap FROM beer b JOIN brewery br on b.brewery_id = br.id JOIN beer_style bs ON b.beer_style_id = bs.id ORDER BY b.on_tap DESC, b.name");
$table .= '<table align="center" cellpadding="0" cellspacing="0" class="db-table"><tr><th></th><th>Name</th> <th>Brewery</th><th>Origin</th><th>Beer Style</th><th>ABV</th><th>IBV</th> <th>Price</th><th>On Tap</th><th></th></tr>';
while ($row = mysqli_fetch_array($result)) {
    $table .= "<td><button type='button' onClick=\"Javascript:window.location.href = 'editBeer.php?rowId=" . $row['id'] . "';\">Edit</button></td>";
    $table .= '<td>' . $row['name'] . '</td>';
    $table .= '<td>' . $row['brewery'] . '</td>';
    $table .= '<td>' . $row['origin'] . '</td>';
    $table .= '<td>' . $row['beer_style'] . '</td>';
    $table .= '<td>' . $row['ABV'] . '</td>';
    $table .= '<td>' . $row['IBU'] . '</td>';
    $table .= '<td>' . $row['price'] . '</td>';
    $table .= '<td> <input name="on_tap" type="checkbox"  disabled="disabled"';
    if ($row['on_tap'] == 1) {
        $table .= 'value="1" checked>';
    } else {
        $table .= 'value="0">';
    }
    $table .= "<td><form method='post'> <button type='button' onClick=\"Javascript:window.location.href = 'deleteBeer.php?rowId=" . $row['id'] . "';\">Delete</button></form></td>";
    $table .= '</td></tr>';
}
$table .= '</table>';
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
    </div>
    <?php echo $table; ?>
</div>
</body>

</html>
