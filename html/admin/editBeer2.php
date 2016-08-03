<?php

?>

<html>
<!DOCTYPE HTML>
<head>
  <title>Edit Beer</title>
</head>
<link rel='stylesheet' type='text/css' href='../stylesheet.css'>
<body>
<!-- Title -->
<div style="width: 100%">
  <div class="title">
    <h3>Edit Beer</h3>
  </div>
</div>
<form method="post">
  <p><label>Name:</label><input type="text" name="name" class="box" value="<?php echo $beerName ?>"></p>
  <p><label>Name:</label><input type="text" name="origin" class="box" value="<?php echo $beerOrigin ?>"></p>

  <p><label>ABV:</lable><input type="text" name="ABV" class="box" value="<?php echo $beerABV ?>"></p>
  <p><label>IBU:</label><input type="text" name="IBU"
</form>
</body>
</html>

