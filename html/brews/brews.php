<?php
/* connect to the db */
include('../config.php');
/* navigation bar */
echo '<div style="width: 100%;">
<div class="navigation-bar">
  <ul>
     <li><a href="../about.html">ABOUT</a></li>
    <li><a href="../kitchen.html">KITCHEN<a/></li>
    <li><a href="../main.html"><img class="logo" src="../pictures/favicon.jpg"></a></li>
    <li><a href="../events/events.php">EVENTS</a></li>
    <li><a href="brews.php">BREWS</a></li>
  </ul>
</div>
</div>';
/* Find all Beers on Tap */
$sql = "SELECT id FROM beer WHERE on_tap=1 ORDER BY id";
$result = mysqli_query($db,$sql);
if(mysqli_num_rows($result)) {
  /* Create Table */
  echo '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
  echo '<tr><th>Beer</th><th>Brewery</th><th>Origin</th><th>Beer Style</th><th>ABV</th><th>IBU</th><th>Price per Pint</th></tr>';
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    echo '<tr>';
    $id = $row["id"];
    /* Beer Name */
    $sql = "SELECT name FROM beer WHERE id='$id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    echo '<td>',$row2["name"],'</td>';
    /* Brewery Name */
    $sql = "SELECT brewery_id FROM beer WHERE id='$id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    $brewery_id = $row2["brewery_id"];
    $sql = "SELECT name FROM brewery WHERE id='$brewery_id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    echo '<td>',$row2["name"],'</td>';
    /* Origin */
    $sql = "SELECT origin FROM beer WHERE id='$id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    echo '<td>',$row2["origin"],'</td>';
    /* Beer Style */
    $sql = "SELECT beer_style_id FROM beer WHERE id='$id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    $beer_style_id = $row2["beer_style_id"];
    $sql = "SELECT name FROM beer_style WHERE id='$beer_style_id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    echo '<td>',$row2["name"],'</td>';
    /* ABV */
    $sql = "SELECT ABV FROM beer WHERE id='$id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    echo '<td>',$row2["ABV"],'</td>';
    /* IBU */
    $sql = "SELECT IBU FROM beer WHERE id='$id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    echo '<td>',$row2["IBU"],'</td>';
    /* price */
    $sql = "SELECT price FROM beer WHERE id='$id'";
    $result2 = mysqli_query($db,$sql);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    echo '<td>',$row2["price"],'</td>';
    echo '</tr>';
  }
  echo '</table>';
}
?>
<html>

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
table.db-table {border-right:1px solid #ccc; border-bottom:1px solid #ccc; }
table.db-table th { background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
table.db-table td { padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
<body>

</body>

</html>
