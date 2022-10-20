<?php
include("../connectdb.php");

// $toolID = $_POST['selectedtoolID'];

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$toolID = $parts['toolidall'];

$deletetoolsql = "DELETE FROM tool_all_table WHERE tool_all_ID = '$toolID'";

$res = $conn->query($deletetoolsql);

// echo "</br>" . mysqli_error($conn);

if ($res) {

    // $comdelconalert = "<script type='text/javascript'> alert('Detele Tool Successfully') </script>";
    // echo $comdelconalert;
    echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
    exit();
} else {

    // $errdelcon = "<script type='text/javascript'> alert('Error : Detele Tool Cancelled') </script>";
    // echo $errdelcon;
    echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
    exit();
}