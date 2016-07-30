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
    Be careful not to navigate away from this page without first saving any changes!
<?php
include "../config.php";
include "session.php";
$beerId = $_GET['rowId'];
$beerName = "";
$beerBreweryId = "";
$beerOrigin = "";
$beerStyleId = "";
$beerABV = "";
$beerIPU = "";
$beerPrice = "";
$beerOnTap = 0;
$newBeer = FALSE;

if ($beerId != null) {
    $result = mysqli_query($db, "SELECT id, name, brewery_id, origin, beer_style_id, ABV, IBU, price, on_tap FROM beer WHERE id = '$beerId'");
    $beerRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($beerRow == NULL) {
        die('I am sorry, we couldn\'t find that beer. :(');
    }
    $beerName = $beerRow['name'];
    $beerOrigin = $beerRow['origin'];
    $beerABV = $beerRow['ABV'];
    $beerIPU = $beerRow['IPU'];
    $beerPrice = $beerRow['price'];
    $beerOnTap = $beerRow['on_tap'];
} else {
    $newBeer = TRUE;
}

$result = mysqli_query($db, "SELECT id, name FROM brewery");
$breweriesHTML = "<select name='brewery_id'>";
if ($newBeer) {
    $breweriesHTML = $breweriesHTML . "<option value = '0' selected > ";
}
while ($row = $result->fetch_assoc()) {
    unset($id, $name);
    $id = $row['id'];
    $name = $row['name'];
    $breweriesHTML = $breweriesHTML . "<option value='" . $id . "'";
    if (!$newBeer && $id == $beerRow['brewery_id']) {
        $breweriesHTML = $breweriesHTML . " selected ";
    }
    $breweriesHTML = $breweriesHTML . ">" . $name . "</option>";

}
$breweriesHTML = $breweriesHTML . "</select>";

$result = mysqli_query($db, "SELECT id, name FROM beer_style");
$beerStylesHTML = "<select name='beer_style_id'>";
if ($newBeer) {
    $beerStylesHTML = $beerStylesHTML . "<option value = '0' selected > ";
}
while ($row = $result->fetch_assoc()) {
    unset($id, $name);
    $id = $row['id'];
    $name = $row['name'];
    $beerStylesHTML = $beerStylesHTML . "<option value='" . $id . "'";
    if (!$newBeer && $id == $beerRow['beer_style_id']) {
        $beerStylesHTML = $beerStylesHTML . " selected ";
    }
    $beerStylesHTML = $beerStylesHTML . ">" . $name . "</option>";
}
$beerStylesHTML = $beerStylesHTML . "</select>";

?>
    <form action="" method="post">
        <p><label>Name:</label><input type="text" name="name" class="box" value='<?php echo $beerName ?>'/><br></p>
        <p><label>Brewery:</label> <?php echo $breweriesHTML; ?><br/></p>
        <p><label>Origin:</label><input type="text" name="origin" class="box" value='<?php echo $beerOrigin ?>'/><br/></p>
        <p><label>Beer Style:</label> <?php echo $beerStylesHTML; ?><br/></p>
        <p><label>ABV:</label><input type="text" name="ABV" class="box" value='<?php echo $beerABV ?>'/>%<br/></p>
        <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $ABVerror; ?></div>
        <p><label>IBU:</label><input type="text" name="IPU" class="box" value='<?php echo $beerIPU ?>'/><br/></p>
        <p><label>Price:</label><input type="text" name="price" class="box" value='<?php echo $beerPrice ?>'/><br/></p>
        <p><?php
        echo "<label>On Tap?</label><input name='onTap' type='checkbox'";
        if (!$newBeer && $beerOnTap == 1) {
            echo " value ='1' checked>";
        } else {
            echo " value ='0'>";
        }?></p>
        </td></tr>
        <input type="button" name="cancel" value="cancel" onClick="window.location='admin.php';" />
        <?php
        if ($newBeer) {
            echo "<input type='submit' value='Create'/>";
        } else {
            echo "<input type='submit' value='Update'/>";
        }
        ?><br/></p>
    </form>
    <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    unset($ABVerror);
    unset($error);

    $beerName = $_POST['name'];
    $beerBreweryId = $_POST['brewery_id'];
    $beerOrigin = $_POST['origin'];
    $beerStyleId = $_POST['beer_style_id'];
    $beerABV = $_POST['ABV'];
    $beerIPU = $_POST['IPU'];
    $beerPrice = $_POST['price'];
    $beerOnTap = $_POST['onTap'];

    if($beerABV>1){
        $error = "ABV is a percentage and must be less than or equal to 1!";
    }else {
        if ($newBeer) {
            $sql = "INSERT INTO beer (name, brewery_id, origin, beer_style_id, ABV, IBU, price, on_tap) VALUES ('$beerName','$beerBreweryId','$beerOrigin','$beerStyleId','$beerABV','$beerIPU','$beerPrice','$beerOnTap')";
        } else {
            $sql = "UPDATE beer SET name = '$beerName',brewery_id = '$beerBreweryId',origin = '$beerOrigin',beer_style_id = '$beerStyleId',ABV = '$beerABV',IBU = '$beerIPU',price = '$beerPrice',on_tap = '$beerOnTap' WHERE id = '$beerId'";
        }
        $result = mysqli_query($db, $sql);

        if (mysqli_affected_rows($db) > 0) {
            header("Location: admin.php");
            die();
        } else {
            $error = "Something went wrong, and your changes have not been saved. Please contact an administrator for help!";
        }
    }
}
?>