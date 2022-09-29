<?php
include("../connectdb.php");

$inputID = $_POST['inpID'];
$toolname = $_POST['toolname'];
$branddef = $_POST['branddef'];
$defmodel = $_POST['defmodel'];
$ttype = $_POST['ttype'];
$picpath = $_POST['picpather'];

if ((!empty($inputID)) && (!empty($toolname)) && (!empty($branddef)) && (!empty($defmodel)) && (!empty($ttype))) {

    $addtoolsql = "INSERT INTO tools_all (ID_all, name, brand, model, type, pic_path) 
        VALUES ($inputID, $toolname, $branddef, $defmodel, $ttype, $picpath)";

    $res = $conn->query($addtoolsql);

    if ($res) {

        $sccaddcon = "<script type='text/javascript'> alert('Add Tool Successfully') </script>";
    } else {

        $erraddcon = "<script type='text/javascript'> alert('Error : Add Tool Cancelled') </script>";
    }
} else {

    $misfrmcon = "<script type='text/javascript'> alert('Missing Form') </script>";
}
