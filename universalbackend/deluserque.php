<?php

include("../connectdb.php");

$uid = $_COOKIE["userck"];

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$queid = $parts["queid"];

$updateledger = "UPDATE ledger_table SET
    queue_status = 5,
    que_ID = NULL
    WHERE que_ID = '$queid'";

$resledger = $conn->query($updateledger);

if ($resledger) {

    $delque = "DELETE FROM queue_table WHERE que_ID = '$queid'";

    $resdelque = $conn->query($delque);

    if ($resdelque) {

        echo "<script type='text/javascript'>location.href='../user/Status.php';</script>";
    } else {

        echo "Layer 2 : " . mysqli_error($conn);
        // echo "<script type='text/javascript'>location.href='../user/Status.php';</script>";
    }
} else {
    
    echo "Layer 1 : " . mysqli_error($conn);
    // echo "<script type='text/javascript'>location.href='../user/Status.php';</script>";
}