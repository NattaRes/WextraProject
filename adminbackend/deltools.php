<?php
include("../connectdb.php");

// $toolID = $_POST['selectedtoolID'];

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$toolID = $parts['toolidall'];

$deletetoolsql = "DELETE FROM tools_all WHERE ID_all = '$toolID'";

function  DelConfirmation()
{
    global $toolID;
    echo '<script type="text/javascript"> ';
    echo 'var inputID = prompt("Delete: ' . $toolID . ' ?", "");';
    echo 'alert(inputID);';
    echo '</script>';
}

$DelConfirmText = DelConfirmation();

echo $DelConfirmText;

// echo "<script type='text/javascript'> alert('" . createConfirmationmbox() . "') </script>";

// $res = $conn->query($deletetoolsql);

// echo "</br>" . mysqli_error($conn);

// if ($res) {

//     // $comdelconalert = "<script type='text/javascript'> alert('Detele Tool Successfully') </script>";
//     // $comdelcon =  "<script type='text/javascript'>location.href='adminsite/menubar.html';</script>";

//     echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=All&sfi=All&sinput=';</script>";
//     exit();
// } else {

//     // $errdelcon = "<script type='text/javascript'> alert('Error : Detele Tool Cancelled') </script>";
// }