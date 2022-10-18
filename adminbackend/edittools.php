<?php
include("../connectdb.php");

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$idall = $parts['toolidall'];

$toolname = $_POST['toolnameinput'];
$branddef = $_POST['branddef'];
$defmodel = $_POST['defmodel'];
$ttype = $_POST['categoryinput'];
$desc = $_POST['description'];
// $picpath = $_POST['picpather'];

// if ((!empty($toolallID)) && (!empty($toolname)) && (!empty($branddef)) && (!empty($defmodel)) && (!empty($ttype))) {

//     $updatetoolsql = "UPDATE tools_all SET name = '$toolname', brand = '$branddef', model = '$defmodel', 
//         type = '$ttype', pic_path = '$picpath' WHERE ID_all = '$idall'";

//     $res = $conn->query($updatetoolsql);

//     if ($res) {

//         // $sccupdcon = "<script type='text/javascript'> alert('Tool Update Successfully') </script>";

//         echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php';</script>";
//         exit();
//     } else {

//         $errupdcon = "<script type='text/javascript'> alert('Error : Tool Update Cancelled') </script>";
//     }
// } else {

//     $misfrmcon = "<script type='text/javascript'> alert('Missing Form') </script>";
// }

$updatetoolsql = "UPDATE tool_all_table SET 
    tool_brand = '$branddef', 
    tool_name = '$toolname', 
    tool_model = '$defmodel', 
    tool_type = '$ttype', 
    tool_desc = '$desc'
    WHERE ID_all = '$idall'";

$res = $conn->query($updatetoolsql);

echo "</br>" . mysqli_error($conn);

if ($res) {

    // $sccupdcon = "<script type='text/javascript'> alert('Tool Update Successfully') </script>";

    echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=All&sfi=All&sinput=';</script>";
    exit();
} else {

    // $errupdcon = "<script type='text/javascript'> alert('Error : Tool Update Cancelled') </script>";
}
