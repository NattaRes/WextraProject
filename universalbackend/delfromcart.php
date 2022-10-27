<?php 

include("../connectdb.php");

$uid = $_COOKIE["userck"];

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$toolidall = $parts["toolidall"];

$delsql = "DELETE FROM tool_cart
    WHERE UID = '$uid'
    AND tool_all_ID = '$toolidall'";

$resdel = $conn->query($delsql);

if ($resdel) {
    
    echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
} else {

    echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
}
