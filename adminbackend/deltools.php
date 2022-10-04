<?php
include("../connectdb.php");

// $toolID = $_POST['selectedtoolID'];

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$toolID = $parts['toolidall'];

$deletetoolsql = "DELETE FROM tools_all WHERE ID_all = '$toolID'";

$res = $conn->query($deletetoolsql);

// echo "</br>" . mysqli_error($conn);

if ($res) {

    // $comdelconalert = "<script type='text/javascript'> alert('Detele Tool Successfully') </script>";
    // $comdelcon =  "<script type='text/javascript'>location.href='adminsite/menubar.html';</script>";

    echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php';</script>";
    exit();
} else {

    // $errdelcon = "<script type='text/javascript'> alert('Error : Detele Tool Cancelled') </script>";
}
