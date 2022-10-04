<?php
include("../connectdb.php");

// $toolID = $_POST['selectedtoolID'];

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$deletetoolsql = "DELETE FROM tools_all WHERE ID_all = $toolID";

$res = $conn->query($deletetoolsql);

if ($res) {

    $erraddcon = "<script type='text/javascript'> alert('Detele Tool Successfully') </script>";
} else {

    $erraddcon = "<script type='text/javascript'> alert('Error : Detele Tool Cancelled') </script>";
}
