<?php

include("../connectdb.php");

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$queid = $parts["queid"];

$decis = $parts["decis"];

$qcheck = "SELECT * FROM queue_table WHERE que_ID = '$queid' AND queue_status = 1";
$resqch = $conn->query($qcheck);
$qcount = mysqli_num_rows($resqch);

if ($qcount > 0) {
    if ($decis == "ap") {

        $aplgrsql = "UPDATE ledger_table SET
                queue_status = 2
                WHERE que_ID = '$queid'";
        $resaplgr = $conn->query($aplgrsql);

        if ($resaplgr) {

            $apquesql = "UPDATE queue_table SET
                queue_status = 2
                WHERE que_ID = '$queid'";

            $resapque = $conn->query($apquesql);

            if ($resapque) {

                // echo "<script type='text/javascript'> alert('Update Successfully') </script>";
                // echo "<script>window.close();</script>";
                echo "<script type='text/javascript'> location.href='../user/page.html';</script>";
            } else {

                echo mysqli_error($conn);
            }
        } else {

            echo mysqli_error($conn);
        }
    } else {

        $cclgrsql = "UPDATE ledger_table SET
            queue_status = 3
            WHERE que_ID = '$queid'";
        $rescclgr = $conn->query($cclgrsql);

        if ($rescclgr) {

            $ccquesql = "DELETE FROM queue_table 
                WHERE que_ID = '$queid'";
            $resccque = $conn->query($ccquesql);

            if ($resccque) {

                // echo "<script type='text/javascript'> alert('Update Successfully') </script>";
                // echo "<script>window.close();</script>";
                echo "<script type='text/javascript'> location.href='../user/page.html';</script>";
            } else {

                echo mysqli_error($conn);
            }
        } else {

            echo mysqli_error($conn);
        }
    }
} else {
    echo "<script type='text/javascript'> location.href='../user/page.html';</script>";
}
