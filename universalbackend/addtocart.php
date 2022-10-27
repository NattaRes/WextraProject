<?php

include("../connectdb.php");

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$toolidall = $parts["toolidall"];

$uid = $_COOKIE["userck"];

$checkcart = "SELECT * FROM tool_cart
    WHERE UID = '$uid'
    AND tool_all_ID = '$toolidall'";

$rescheck = $conn->query($checkcart);

if ($rescheck) {

    echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
} else {

    $addcartsql = "INSERT INTO tool_cart
    (UID, tool_all_ID, quantity)
    VALUES ('$uid', '$toolidall', 0)";

    $rescart = $conn->query($addcartsql);

    if ($rescart) {

        echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
    } else {

        echo $conn->error;
        // echo "<script type='text/javascript'> alert('Error : " . $conn->error ."') </script>";
        echo "<script type='text/javascript'>location.href='../user/Alltools.php';</script>";
    }
}
