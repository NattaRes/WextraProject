<?php
include("../connectdb.php");

$toolallID = $_POST['toolallID'];
$toolname = $_POST['toolname'];
$branddef = $_POST['branddef'];
$defmodel = $_POST['defmodel'];
$ttype = $_POST['ttype'];
$picpath = $_POST['picpather'];

if ((!empty($toolallID)) && (!empty($toolname)) && (!empty($branddef)) && (!empty($defmodel)) && (!empty($ttype))) {

    $updatetoolsql = "UPDATE tools_all SET name = $toolname, brand = $branddef, model = $defmodel, 
        type = $ttype, pic_path = $picpath WHERE ID_all = $toolallID";

    $res = $conn->query($updatetoolsql);

    if ($res) {

        $sccupdcon = "<script type='text/javascript'> alert('Tool Update Successfully') </script>";
    } else {

        $errupdcon = "<script type='text/javascript'> alert('Error : Tool Update Cancelled') </script>";
    }
} else {

    $misfrmcon = "<script type='text/javascript'> alert('Missing Form') </script>";
}
