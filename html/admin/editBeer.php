<?php
include "../config.php";
include "session.php";
$beerId = $_GET['rowId'];
$beerName = "";
$beerBreweryId = "";
$beerOrigin = "";
$beerStyleId = "";
$beerABV = "";
$beerIBU = "";
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
    $beerIBU = $beerRow['IBU'];
    $beerPrice = $beerRow['price'];
    $beerOnTap = $beerRow['on_tap'];
} else {
    $newBeer = TRUE;
}

$result = mysqli_query($db, "SELECT id, name FROM brewery ORDER BY name DESC");
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

if ($_POST['save']) {
    unset($ABVerror);
    unset($breweryError);
    unset($beerStyleError);

    $beerName = $_POST['name'];
    $beerBreweryId = $_POST['brewery_id'];
    $beerOrigin = $_POST['origin'];
    $beerStyleId = $_POST['beer_style_id'];
    $beerABV = $_POST['ABV'];
    $beerIBU = $_POST['IBU'];
    $beerPrice = $_POST['price'];
    $beerOnTap = isset($_POST['onTap'])?1:0;

    $valid = true;

    if($beerName=="" ){
        $nameError = "The beer must have a name!";
        $valid = false;
    }
    if ($beerBreweryId == 0 ) {
        $breweryError = "You must specify a Brewery!";
        $valid = false;
    }
    if ($beerStyleId == 0) {
        $beerStyleError = "You must specify a Beer Style!";
        $valid = false;
    }
    if ($valid) {
        if ($newBeer) {
            $sql = "INSERT INTO beer (name, brewery_id, origin, beer_style_id, ABV, IBU, price, on_tap) VALUES (\"$beerName\",$beerBreweryId,". ($beerOrigin==""? "NULL" : "\"$beerOrigin\"") . ",$beerStyleId,". ($beerABV==""? "NULL" : $beerABV) . ",". ($beerIBU==""? "NULL" : $beerIBU) . ",". ($beerPrice==""? "NULL" : $beerPrice) . ",$beerOnTap)";
        } else {
            $sql = "UPDATE beer SET name = \"$beerName\",brewery_id = $beerBreweryId,origin = ". ($beerOrigin==""? "NULL" : "\"$beerOrigin\"") . ",beer_style_id = $beerStyleId,ABV =  ". ($beerABV==""? "NULL" : $beerABV) . ",IBU = ". ($beerIBU==""? "NULL" : $beerIBU) . ",price = ". ($beerPrice==""? "NULL" : $beerPrice) . ",on_tap = $beerOnTap WHERE id = $beerId";
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
  <?php
    if ($newBeer) {
        echo "<title>New Beer</title>";
    } else {
        echo "<title>Edit Beer</title>";
    }
  ?>
</head>
<link rel='stylesheet' type='text/css' href='../stylesheet.css'>
<body>
<!-- Title -->
<div style="width: 100%;">
    <div class="title">
        <?php
          if ($newBeer) {
            echo "<h3>New Beer</h3>";
          } else {
            echo "<h3>Edit Beer</h3>";
          }
        ?>
    </div>
</div>
<form action="" method="post">
    <p><label>*Name:</label><input type="text" name="name" class="box" value="<?php echo $beerName ?>"><br></p>
    <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $nameError; ?></div>

    <p><label>*Brewery:</label> <?php echo $breweriesHTML; ?><br></p>
    <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $breweryError; ?></div>

    <p><label>Origin:</label><input type="text" name="origin" class="box" value="<?php echo $beerOrigin ?>"><br></p>

    <p><label>*Beer Style:</label> <?php echo $beerStylesHTML; ?><br></p>
    <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $beerStyleError; ?></div>

    <p><label>ABV:</label><input type="text" name="ABV" class="box" value="<?php echo $beerABV ?>">%<br></p>

    <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $ABVerror; ?></div>
    <p><label>IBU:</label><input type="text" name="IBU" class="box" value="<?php echo $beerIBU ?>"><br></p>

    <p><label>Price:</label><input type="text" name="price" class="box" value="<?php echo $beerPrice ?>"><br></p>

    <p><?php
        echo "<label>On Tap?</label><input name='onTap' type='checkbox'";
        if ($beerOnTap == 1) {
            echo "checked>";
        } else {
            echo ">";
        } ?></p>
    <input type="button" name="cancel" value="Cancel" onClick="window.location='admin.php';">
    <?php
    if ($newBeer) {
        echo "<input type='submit' name ='save' value='Create'/>";
    } else {
        echo "<input type='submit' name ='save' value='Update'/>";
    }
    ?><br></p>
    <p>* Required fields</p>
</form>
</body>

</html>

