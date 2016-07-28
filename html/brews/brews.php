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

<style>
/* -- Logo -- */
.logo {
  float: center;
  max-width: 80px;
  max-height: 80px;
  margin-bottom: -25px;
}
/* ~~ Top Navigation Bar ~~ */
.navigation-bar {
  height: 70px;
  width: 100%;
  margin-bottom: 1ex;
}
.navigation-bar ul {
  padding: 0px;
  margin: 0px;
  text-align: center;
}
.navigation-bar li {
  list-style-type: none;
  padding: 0px;
  height: 24px;
  margin-top: 4px;
  margin-bottom: 4px;
  text-align: center;
  display: inline;
}
.navigation-bar li a {
  color: gray;
  font-size: 16px;
  font-family: 'Ubuntu', Helvetica, Arial, sans-serif;
  text-decoration: none;
  padding: 0px 0px 0px 10px;
}
/* Table */
table.db-table {text-align: center; border-right:1px solid #ccc; border-bottom:1px solid #ccc; }
table.db-table th {text-align: center; background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
table.db-table td {text-align: center; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>

<body>
<!-- Navigation Bar -->
<div style="width: 100%;">
<div class="navigation-bar">
  <ul>
    <li><a href="../about.html">ABOUT</a></li>
    <li><a href="../kitchen.html">KITCHEN<a/></li>
    <li><a href="../main.html"><img class="logo" src="../pictures/favicon.jpg"></a></li>
    <li><a href="../events/events.php">EVENTS</a></li>
    <li><a href="../brews/brews.php">BREWS</a></li>
  </ul>
</div>
</div>
<!-- Table -->
<div class="margin">
  <?php echo $table; ?>
</div>
</body>

</html>
