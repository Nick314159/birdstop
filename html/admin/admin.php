<?php
include_once "../config.php";
?>
<link rel='stylesheet' type='text/css' href='../stylesheet.css'/>
<div style="width: 100%;">
    <div class="navigation-bar">
        <ul>
            <li><a href="../about.html">ABOUT</a></li>
            <li><a href="../kitchen.html">KITCHEN<a/></li>
            <li><a href="../main.html"><img class="logo" src="../pictures/logo.png-8"></a></li>
            <li><a href="../events/events.php">EVENTS</a></li>
            <li><a href="../brews/brews.php">BREWS</a></li>
        </ul>
    </div>
    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Administrator Portal</title>
    </head>
    <body>
    <meta charset="utf-8">
    <h3 style="color: rgb(0, 0, 0); font-family: Lobster, Georgia,
Times, serif; font-style: normal; font-variant: normal;
letter-spacing: normal; line-height: normal; orphans: auto;
text-align: center; text-indent: 0px; text-transform: none;
white-space: normal; widows: 1; word-spacing: 0px;
-webkit-text-stroke-width: 0px;">Administrator Portal</h3>
    <h4>Beers<br>
        <button type='button' onClick="Javascript:window.location.href = 'editBeer.php'">Add New Beer</button>
        <table>
            <?php
            $result = mysqli_query($db, "SELECT b.id, b.name, br.name as brewery, b.origin, bs.name as beer_style, b.ABV, b.IBU, b.price, b.on_tap FROM beer b JOIN brewery br on b.brewery_id = br.id JOIN beer_style bs ON b.beer_style_id = bs.id ORDER BY b.on_tap DESC, b.name");
            echo "<table class=db-table>
        <tr><th></th><th>Name</th> <th>Brewery</th><th>Origin</th><th>Beer Style</th><th>ABV</th><th>IBV</th> <th>Price</th><th>On Tap</th></tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr row" . $row['id'] . ">";
                echo "<td><button type='button' onClick=\"Javascript:window.location.href = 'editBeer.php?rowId=" . $row['id'] . "';\">Edit</button></td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['brewery'] . "</td>";
                echo "<td>" . $row['origin'] . "</td>";
                echo "<td>" . $row['beer_style'] . "</td>";
                echo "<td>" . $row['ABV'] . "</td>";
                echo "<td>" . $row['IBU'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td> <input name='on_tap' type='checkbox'  disabled='disabled'";
                if ($row['on_tap'] == 1) {
                    echo " value ='1' checked";
                } else {
                    echo " value ='0'";
                }
                echo "></td></tr>";
            }
            ?>
        </table>
    </body>
    </html>
