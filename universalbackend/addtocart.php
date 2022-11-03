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

$counter = mysqli_num_rows($rescheck);

if ($rescheck) {

    if ($counter < 1) {

        $addcartsql = "INSERT INTO tool_cart
            (UID, tool_all_ID, quantity, cart_status_ID)
            VALUES ('$uid', '$toolidall', 1, 1)";

        $rescart = $conn->query($addcartsql);

        if ($rescart) {

            echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
        } else {

            echo "<script type='text/javascript'> alert('Error (INSERT) : " .  mysqli_error($conn) . "') </script>";
            echo "<script type='text/javascript'>location.href='../user/Alltools.php';</script>";
        }
    } else {

        echo "<script type='text/javascript'> alert('Error (EMPTY) : " . mysqli_error($conn) . "') </script>";
        echo "<script type='text/javascript'>location.href='../user/Alltools.php';</script>";
    }
} else {

    echo "<script type='text/javascript'> alert('Error (RESULT) : " . mysqli_error($conn) . "') </script>";
    echo "<script type='text/javascript'>location.href='../user/Alltools.php';</script>";
}
