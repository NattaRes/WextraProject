<?php

include("../connectdb.php");

$fromcart = $_POST["carter"];

$uid = $_COOKIE["userck"];

$resetsql = "UPDATE tool_cart SET
    cart_status_ID = 1
    WHERE UID = '$uid'";

$res = $conn->query($resetsql);

if ($res) {

    for ($i = 0; $i < sizeof($fromcart); $i++) {
        $selectersql = "UPDATE tool_cart SET
            cart_status_ID = 2
            WHERE UID = '$uid'
            AND tool_all_ID = '$fromcart[$i]'";

        $resselect = $conn->query($selectersql);
    }

    echo "<script type='text/javascript'>location.href='../user/AllowPage.php';</script>";
} else {

    echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
}
