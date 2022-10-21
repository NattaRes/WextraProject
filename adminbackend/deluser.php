<?php
include("../connectdb.php");

// $toolID = $_POST['selectedtoolID'];

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$uid = $parts['checker'];

// echo $toolID;

$confirmid = $parts['idconfirm'];

// echo $confirmid;

if ($uid == $confirmid) {

    $deletetoolsql = "DELETE FROM user WHERE UID = '$uid'";

    $res = $conn->query($deletetoolsql);

    echo "</br>" . mysqli_error($conn);

    $comdelconalert = "<script type='text/javascript'> alert('Detele Tool Successfully') </script>";
    $errdelcon = "<script type='text/javascript'> alert('Error : Detele Tool Cancelled') </script>";

    if ($res) {

        // echo $comdelconalert;
        echo "<script type='text/javascript'>location.href='../adminsite/ManageUser.php?sfi=all&sinput=';</script>";
        exit();
    } else {

        // echo $errdelcon;
        echo "<script type='text/javascript'>location.href='../adminsite/ManageUser.php?sfi=all&sinput=';</script>";
        exit();
    }
} else {

    // echo $errdelcon;
    echo "<script type='text/javascript'>location.href='../adminsite/ManageUser.php?sfi=all&sinput=';</script>";
    exit();
}