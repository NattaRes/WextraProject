<?php
include("../connectdb.php");

$inputID = $_POST['toolidinput'];
$toolname = $_POST['toolnameinput'];
$branddef = $_POST['branddef'];
$defmodel = $_POST['defmodel'];
$ttype = $_POST['categoryinput'];
// $picpath = $_POST['picpather'];
$picpath = "";

// if ((!empty($inputID)) && (!empty($toolname)) && (!empty($branddef)) && (!empty($defmodel)) && (!empty($ttype))) {

    // if (!isset($picpath)) {
    //     $picpath = "";
    // }
    $addtoolsql = "INSERT INTO tools_all (ID_all, name, brand, model, type, usable_quantity, defect_quantity, lost_quantity) 
        VALUES ('$inputID', '$toolname', '$branddef', '$defmodel', '$ttype', '0', '0', '0')";

    $res = $conn->query($addtoolsql);

    if ($res) {

        echo "<script type='text/javascript'> alert('Add Tool Successfully') </script>";
        echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php';</script>";
    } else {

        echo $conn->error;
        // echo "<script type='text/javascript'> alert('Error : " . $conn->error ."') </script>";
        // echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php';</script>";
    }
// } else {

//     $misfrmcon = "<script type='text/javascript'> alert('Missing Form') </script>";
// }
