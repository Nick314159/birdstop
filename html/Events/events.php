<?php

?>
<html>

<head>
  <title>Events</title>
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
    <li><a href="events.php">EVENTS</a></li>
    <li><a href="../brews/brews.php">BREWS</a></li>
  </ul>
</div>
</div>
</body>

</html>
