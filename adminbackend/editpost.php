<?php

include("../connectdb.php");

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$poid = $parts['poid'];

$post_title = $_POST['pti'];
$post_date = $_POST['pdt'];
$desc = $_POST['description'];

$updatepostsql = "UPDATE post_table SET
    post_title = '$post_title',
    post_time = '$post_date',
    post_desc = '$desc'
    WHERE post_ID = '$poid'";

$res = $conn->query($updatepostsql);

if ($res) {

    echo "<script type='text/javascript'> alert('Update Post Successfully') </script>";
    echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
} else {
    
    echo $conn->error;
    echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
}
