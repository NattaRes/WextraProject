<?php

include("../connectdb.php");

$post_title = $_POST['pti'];
$post_date = $_POST['pdt'];
$desc = $_POST['description'];
$uid = $_COOKIE["userck"];



$picpath = "../image/posts/";
$fileone = $picpath . basename($_FILES["picupload"]["name"]);
$uploadint = 1;
$imgfiletype = strtolower(pathinfo($fileone, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
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

    $pather = "../image/posts/post_default.png";

    $addpostsql = "INSERT INTO post_table
        (post_title, post_time, post_desc, post_pic_path, UID)
        VALUES ('$post_title', '$post_date', '$desc', '$pather', '$uid')";

    $res = $conn->query($addpostsql);

    if ($res) {

        echo "<script type='text/javascript'> alert('Create Post Successfully') </script>";
        echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
    } else {

        echo $conn->error;
        echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
    }
} else {
    if (move_uploaded_file($_FILES["picupload"]["tmp_name"], $fileone)) {
        echo "The file " . htmlspecialchars(basename($_FILES["picupload"]["name"])) . " has been uploaded.";
        $pather = $fileone;
        // echo $pather;

        $addpostsql = "INSERT INTO post_table
                (post_title, post_time, post_desc, post_pic_path, UID)
                VALUES ('$post_title', '$post_date', '$desc', '$pather', '$uid')";

        $res = $conn->query($addpostsql);

        if ($res) {

            echo "<script type='text/javascript'> alert('Create Post Successfully') </script>";
            echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
        } else {

            echo $conn->error;
            echo "<script type='text/javascript'>location.href='../adminsite/Post.php?sfi=all&sinput=';</script>";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
