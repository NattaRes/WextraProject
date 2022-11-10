<?php
include("../connectdb.php");

$uid = $_COOKIE["userck"];

$nusername = $_POST["iname"];
$nemail = $_POST["inemail"];
$nphone = $_POST["inphone"];
// https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg

$picpath = "../image/user/";
$fileone = $picpath . basename($_FILES["picupload"]["name"]);
$uploadint = 1;
$imgfiletype = strtolower(pathinfo($fileone, PATHINFO_EXTENSION));
$filexplode = explode(".", $_FILES["picupload"]["name"]);
$newname = $uid . '.' . end($filexplode);

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

    $oldpic = "SELECT profile_pic_path FROM user
        WHERE UID = '$uid'";
    $resoldpic = $conn->query($oldpic);

    while ($picrow = mysqli_fetch_array($resoldpic)) {
        $pather = $picrow["profile_pic_path"];
    }

    $usersql = "UPDATE user SET
        username = '$nusername',
        email = '$nemail',
        phonenum = '$nphone',
        profile_pic_path = '$pather'
        WHERE UID = '$uid'";

    $resuserudt = $conn->query($usersql);

    if ($resuserudt) {

        echo "<script type='text/javascript'> alert('Profile updated.') </script>";
        echo "<script type='text/javascript'>location.href='../user/Profile.php';</script>";
        exit();
    } else {

        echo "<script type='text/javascript'>location.href='../user/Profile.php';</script>";
        exit();
    }
} else {
    if (move_uploaded_file($_FILES["picupload"]["tmp_name"], $picpath . $newname)) {
        echo "The file " . htmlspecialchars(basename($_FILES["picupload"]["name"])) . " has been uploaded.";
        $pather = $picpath . $newname;
        // echo $pather;

        $usersql = "UPDATE user SET
            username = '$nusername',
            email = '$nemail',
            phonenum = '$nphone',
            profile_pic_path = '$pather'
            WHERE UID = '$uid'";

        $resuserudt = $conn->query($usersql);

        if ($resuserudt) {

            echo "<script type='text/javascript'> alert('Profile updated.') </script>";
            echo "<script type='text/javascript'>location.href='../user/Profile.php';</script>";
            exit();
        } else {

            echo "<script type='text/javascript'>location.href='../user/Profile.php';</script>";
            exit();
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
