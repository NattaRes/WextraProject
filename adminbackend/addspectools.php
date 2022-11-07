<?php 

include("../connectdb.php");

$specID = $_POST["specificID"];
$toolidall = $_POST["toolidall"];
$statselect = $_POST["statusct"];

$toolspecinsert = "INSERT INTO tool_specific_table
    (tool_spec_ID, tool_all_ID, tool_status)
    VALUES ('$specID', '$toolidall', '$statselect')";
$restsin = $conn->query($toolspecinsert);

if ($restsin) {

    echo "<script type='text/javascript'>location.href='../adminsite/Viewtools.php?toolidall=" . $toolidall . "';</script>";
} else {

    echo "<script type='text/javascript'>location.href='../adminsite/Viewtools.php?toolidall=" . $toolidall . "';</script>";
}

?>