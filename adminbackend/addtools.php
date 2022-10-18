<?php
include("../connectdb.php");

$inputID = $_POST['toolidinput'];
$toolname = $_POST['toolnameinput'];
$branddef = $_POST['branddef'];
$defmodel = $_POST['defmodel'];
$ttype = $_POST['categoryinput'];
$desc = $_POST['description'];
// $picpath = $_POST['picpather'];
$picpath = "";

// if ((!empty($inputID)) && (!empty($toolname)) && (!empty($branddef)) && (!empty($defmodel)) && (!empty($ttype))) {

// if (!isset($picpath)) {
//     $picpath = "";
// }
$addtoolsql = "INSERT INTO tool_all_table 
    (tool_all_ID, tool_brand, tool_name, tool_model, tool_type, tool_desc, tool_pic_path) 
    VALUES ('$inputID', '$branddef', '$toolname', '$defmodel', '$ttype', '$desc', '$picpath')";

$res = $conn->query($addtoolsql);

if ($res) {

    echo "<script type='text/javascript'> alert('Add Tool Successfully') </script>";
    echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
} else {

    echo $conn->error;
    // echo "<script type='text/javascript'> alert('Error : " . $conn->error ."') </script>";
    // echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php';</script>";
}
// } else {

//     $misfrmcon = "<script type='text/javascript'> alert('Missing Form') </script>";
// }
