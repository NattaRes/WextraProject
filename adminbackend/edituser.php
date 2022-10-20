<?php

include("../connectdb.php");

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$uid = $parts['uid'];

$newpass = $parts['newpass'];

$hshnewpass = hash('sha256', $newpass);

$tablequery = "UPDATE user SET
    password = '$hshnewpass'
    WHERE UID = '$uid'";

$res = $conn->query($tablequery);

if ($res) {

    // $sccupdcon = "<script type='text/javascript'> alert('Tool Update Successfully') </script>";

    echo "<script type='text/javascript'>location.href='../adminsite/ManageUser.php?sfi=all&sinput=';</script>";
    exit();
} else {

    // $errupdcon = "<script type='text/javascript'> alert('Error : Tool Update Cancelled') </script>";

    echo "<script type='text/javascript'>location.href='../adminsite/ManageUser.php?sfi=all&sinput=';</script>";
    exit();
}