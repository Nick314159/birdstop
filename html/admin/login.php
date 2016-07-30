<?php
include("../config.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    unset($error);
    if ((hash("md5", $_POST['username']) == $adminUsername) && (hash("md5", $_POST['password']) == $adminPassword)) {
        $_SESSION['loggedIn'] = true;
        header("location: admin.php");
    } else {
        $error = "Invalid username of password. Please try again.";
    }
}
?>
<html>
<!DOCTYPE HTML>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Admin Login</title>
</head>
<link rel='stylesheet' type='text/css' href='../stylesheet.css'/>
<body>
<!-- Title -->
<div style="width: 100%;">
    <div class="title">
        <h3>Login</h3>
    </div>
</div>
<form action="" method="post">
    <label>Username: </label><input type="text" name="username" class="box"/><br/><br/>
    <label>Password: </label><input type="password" name="password" class="box"/><br/><br/>
    <input type="submit" value=" Submit "/><br/>
</form>
<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</body>
</html>
<?php
session_start();
include("../config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    unset($error);
    if ((hash("md5", $_POST['username']) == $adminUsername) && (hash("md5", $_POST['password']) == $adminPassword)) {
        $loggedIn = true;
        header("location: admin.php");
    } else {
        $error = "Invalid username of password. Please try again.";
    }
}
?>

