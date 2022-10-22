<?php 

include("../connectdb.php");

$brandname = $_POST["brandname"];

$addbrandsql = "INSERT INTO tool_brand_table
    (brand_name)
    VALUES ('$brandname')";

$res = $conn->query($addbrandsql);

if ($res) {
    
    echo "<script type='text/javascript'> alert('Add Brand Successfully') </script>";
    echo "<script type='text/javascript'>location.href='../adminsite/Catagory.php';</script>";
} else {

    echo $conn->error;
    echo "<script type='text/javascript'>location.href='../adminsite/Catagory.php';</script>";
}