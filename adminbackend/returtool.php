<?php

include("../connectdb.php");

$specarr = $_POST["toolspec"];
$queid = $_POST["queid"];
$ledgernum = $_POST["ledgerID"];
$statarr = $_POST["tstat"];

$updateque = "UPDATE queue_table SET
    queue_status = 7
    WHERE que_ID = '$queid'";
$resupque = $conn->query($updateque);

if ($resupque) {

    for ($i = 0; $i < sizeof($ledgernum); $i++) {

        $updateledger = "UPDATE ledger_table SET
            queue_status = 7
            WHERE Ledger_num = '$ledgernum[$i]'";
        $resupled = $conn->query($updateledger);
    }
    if ($resupled) {

        for ($x = 0; $x < sizeof($specarr); $x++) {

            $updatespstat = "UPDATE tool_specific_table SET
                tool_status = '$statarr[$x]'
                WHERE tool_spec_ID = '$specarr[$x]'";
            $resupspst = $conn->query($updatespstat);
        }
        
        if ($resupspst) {

            echo "<script type='text/javascript'>location.href='../adminsite/Listborrowgive.php';</script>";
        } else {

            echo "error : " . mysqli_error($conn);
        }
    } else {

        echo "error : " . mysqli_error($conn);
    }
} else {

    echo "error : " . mysqli_error($conn);
}
