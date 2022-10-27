<?php 

include("../connectdb.php");

$post_title = $_POST['pti'];
$post_date = $_POST['pdt'];
$desc = $_POST['description'];
$pic_default = "../image/post_default.png";

$uid = $_COOKIE["userck"];

$addpostsql = "INSERT INTO post_table
    (post_title, post_time, post_desc, post_pic_path, UID)
    VALUES ('$post_title', '$post_date', '$desc', '$pic_default', '$uid')";

$res = $conn->query($addpostsql);

if ($res) {
    
    echo "<script type='text/javascript'> alert('Create Post Successfully') </script>";
    echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
} else {

    echo $conn->error;
    echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
}