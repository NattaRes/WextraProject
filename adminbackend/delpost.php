<?php

include("../connectdb.php");

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$poid = $parts['poid'];

$delpostsql = "DELETE FROM post_table WHERE post_ID = '$poid'";

$res = $conn->query($delpostsql);

if ($res) {

    echo "<script type='text/javascript'> alert('Delete Post Successfully') </script>";
    echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
} else {

    echo $conn->error;
    echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
}
