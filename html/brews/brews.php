<?php
/* connect to the db */
include('../config.php');
/* Find all Beers on Tap */
$sql = "SELECT b.id, b.name, br.name as brewery, b.origin, bs.name as beer_style, b.ABV, b.IBU, b.price FROM beer b JOIN brewery br on b.brewery_id = br.id JOIN beer_style bs ON b.beer_style_id = bs.id  WHERE b.on_tap = 1 ORDER BY b.name";
$result = mysqli_query($db,$sql);
if(mysqli_num_rows($result)) {
  /* Create Table */
  $table .= '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
  $table .= '<tr><th>Beer</th><th>Brewery</th><th>Origin</th><th>Beer Style</th><th>ABV</th><th>IBU</th><th>Price per Pint</th></tr>';
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    $table .= '<tr>';
    /* Beer Name */
    $table .= '<td>' . $row['name'] . '</td>';
    /* Brewery Name */
    $table .= '<td>' . $row['brewery'] . '</td>';
    /* Origin */
    $table .= '<td>' . $row['origin'] . '</td>';
    /* Beer Style */
    $table .= '<td>' . $row['beer_style'] . '</td>';
    /* ABV */
    $table .= '<td>' . $row['ABV'] . '</td>';
    /* IBU */
    $table .= '<td>' . $row['IBU'] . '</td>';
    /* price */
    $table .= '<td>' . $row['price'] . '</td>';
    $table .= '</tr>';
  }
  $table .= '</table>';
}
?>

<html>
<!DOCTYPE HTML>
<head>
  <title>Brews</title>
</head>
<link rel='stylesheet' type='text/css' href='../stylesheet.css'/>
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
<div class="margin">
  <?php echo $table; ?>
</div>
<!-- Footer with admin login -->
<footer>
  <p><a href="../admin/admin.php">Admin Login<a/></p>
</footer>

</body>

</html>
