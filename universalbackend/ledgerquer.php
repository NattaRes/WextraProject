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

$fromselect = "SELECT tool_all_ID FROM tool_cart
    WHERE UID = '$uid'
    AND cart_status_ID = 2";

$resfs = $conn->query($fromselect);

// $countitem = mysqli_num_rows($resfs);

// echo $countitem;
// while ($row = mysqli_fetch_array($resfs)) {
//     echo "ALL : " . print_r($row) . "</br>";
//     echo $row["tool_all_ID"] . "</br>";
// }

$insertque = "INSERT INTO queue_table
    (que_owner_UID, s_date, e_date, queue_status)
    VALUES ('$uid', '$s_date', '$e_date', 1)";

$resinsertque = $conn->query($insertque);

if ($resinsertque) {

    $selque = "SELECT * FROM queue_table 
        WHERE (que_owner_UID = '$uid') 
        AND (s_date = '$s_date') 
        AND (e_date = '$e_date')";

    $resselque = $conn->query($selque);

    while ($selque = mysqli_fetch_array($resselque)) {
        $qid = $selque["que_ID"];
    }

    if ($resselque) {

        while ($row = mysqli_fetch_array($resfs)) {

            $toolidall = $row["tool_all_ID"];

            $inserteer = "INSERT INTO ledger_table 
            (que_ID, user_UID, tool_all_ID, tool_spec_ID, approver_UID, s_date, e_date, que_desc, queue_status) 
            VALUES ('$qid', '$uid', '$toolidall', NULL, '$approver_UID', '$s_date', '$e_date', '$que_desc', 1)";

            $resinsertledger = $conn->query($inserteer);

            if ($resinsertledger) {

                echo "<script type='text/javascript'>location.href='../user/Status.php';</script>";
            } else {

                echo "<script type='text/javascript'>location.href='../user/Status.php';</script>";
            }
        }
    } else {
        echo "<script type='text/javascript'> alert('Error : " .  mysqli_error($conn) . "') </script>";
        echo "<script type='text/javascript'>location.href='../user/Alltools.php';</script>";
    }
} else {
    echo "<script type='text/javascript'> alert('Error : " .  mysqli_error($conn) . "') </script>";
    echo "<script type='text/javascript'>location.href='../user/Alltools.php';</script>";
}
