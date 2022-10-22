<?php 

include("../connectdb.php");

$catename = $_POST["catename"];

$addcatesql = "INSERT INTO tool_type_table
    (type_name)
    VALUES ('$catename')";

$res = $conn->query($addcatesql);

if ($res) {
    
    echo "<script type='text/javascript'> alert('Add Category Successfully') </script>";
    echo "<script type='text/javascript'>location.href='../adminsite/Catagory.php';</script>";
} else {

    echo $conn->error;
    echo "<script type='text/javascript'>location.href='../adminsite/Catagory.php';</script>";
}