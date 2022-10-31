<?php
include("../connectdb.php");

$uid = $_COOKIE["userck"];

$nusername = $_POST["iname"];
$nemail = $_POST["inemail"];
$nphone = $_POST["inphone"];

$usersql = "UPDATE user SET
    username = '$nusername',
    email = '$nemail',
    phonenum = '$nphone'
    WHERE UID = '$uid'";

$resuserudt = $conn->query($usersql);

if ($resuserudt) {

    echo "<script type='text/javascript'>location.href='../user/Profile.php';</script>";
    exit();
} else {

    echo "<script type='text/javascript'>location.href='../user/Profile.php';</script>";
    exit();
}
