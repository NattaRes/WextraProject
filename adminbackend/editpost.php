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

// Check if image file is a actual image or fake image
if (isset($_FILES["picupload"]["name"])) {
    $picpath = "../image/posts/";
    $fileone = $picpath . basename($_FILES["picupload"]["name"]);
    $uploadint = 1;
    $imgfiletype = strtolower(pathinfo($fileone, PATHINFO_EXTENSION));
    $filexplode = explode(".", $_FILES["picupload"]["name"]);
    $newname = $poid . '.' . end($filexplode);

    $check = getimagesize($_FILES["picupload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadint = 1;
    } else {
        echo "File is not an image.";
        $uploadint = 0;
    }
}

// Check file size
if ($_FILES["picupload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadint = 0;
}

// Allow certain file formats
if ($imgfiletype != "jpg" && $imgfiletype != "png" && $imgfiletype != "jpeg" && $imgfiletype != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadint = 0;
}

// Check if $uploadint is set to 0 by an error
if ($uploadint == 0) {
    echo "Sorry, your file was not uploaded.";

    $oldpic = "SELECT post_pic_path FROM post_table
        WHERE post_ID = '$poid'";
    $resoldpic = $conn->query($oldpic);

    while ($picrow = mysqli_fetch_array($resoldpic)) {
        $pather = $picrow["post_pic_path"];
    }

    $updatepostsql = "UPDATE post_table SET
        post_title = '$post_title',
        post_time = '$post_date',
        post_desc = '$desc',
        post_pic_path = '$pather'
        WHERE post_ID = '$poid'";

    $res = $conn->query($updatepostsql);

    if ($res) {

        echo "<script type='text/javascript'> alert('Update Post Successfully') </script>";
        echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
    } else {

        echo $conn->error;
        echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
    }
} else {
    if (move_uploaded_file($_FILES["picupload"]["tmp_name"], $picpath . $newname)) {
        echo "The file " . htmlspecialchars(basename($_FILES["picupload"]["name"])) . " has been uploaded.";
        $pather = $picpath . $newname;
        // echo $pather;

        $updatepostsql = "UPDATE post_table SET
            post_title = '$post_title',
            post_time = '$post_date',
            post_desc = '$desc',
            post_pic_path = '$pather'
            WHERE post_ID = '$poid'";

        $res = $conn->query($updatepostsql);

        if ($res) {

            echo "<script type='text/javascript'> alert('Update Post Successfully') </script>";
            echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
        } else {

            echo $conn->error;
            echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
