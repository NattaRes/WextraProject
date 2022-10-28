<?php

include("../connectdb.php");

$uid = $_COOKIE["userck"];

$approver_UID = $_POST["approver_UID"];
$s_date = $_POST["s_date"];
$e_date = $_POST["e_date"];
$que_desc = $_POST["que_desc"];

// echo $uid;
// echo $approver_UID;
// echo $s_date;
// echo $e_date;
// echo $que_desc;

// $fromselect = "INSERT INTO ledger_table
//     (UID, tool_all_ID, tool_spec_ID, approver_UID, s_date, e_date, que_desc, queue_status) 
//     VALUES ('$uid', 
//         SELECT tool_cart.tool_all_ID FROM tool_cart
//         WHERE UID = '$uid'
//         AND cart_status_ID = 2,
//     NULL , '$approver_UID', '$s_date', '$e_date', '$que_desc', '1')";

$fromselect = "SELECT tool_all_ID FROM tool_cart
    WHERE UID = '$uid'
    AND cart_status_ID = 2";

$resfs = $conn->query($fromselect);

// $countitem = mysqli_num_rows($resfs);

// echo $countitem;
while ($row = mysqli_fetch_array($resfs)) {
    echo print_r($row);
}

// echo "<script type='text/javascript'>location.href='../user/Status.html';</script>";
