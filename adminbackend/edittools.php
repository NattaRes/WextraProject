<?php
include("../connectdb.php");

$url = $_SERVER['REQUEST_URI'];

// echo $url;

$partscrap = parse_url($url);

parse_str($partscrap['query'], $parts);

$idall = $parts['toolidall'];

$toolname = $_POST['toolnameinput'];
$branddef = $_POST['branddef'];
$defmodel = $_POST['defmodel'];
$ttype = $_POST['categoryinput'];
$desc = $_POST['description'];

$picpath = "../image/tools/";
$fileone = $picpath . basename($_FILES["picupload"]["name"]);
$uploadint = 1;
$imgfiletype = strtolower(pathinfo($fileone, PATHINFO_EXTENSION));
$filexplode = explode(".", $_FILES["picupload"]["name"]);
$newname = $idall . '.' . end($filexplode);

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

    $oldpic = "SELECT tool_pic_path FROM tool_all_table
        WHERE tool_all_ID = '$idall'";
    $resoldpic = $conn->query($oldpic);

    while ($picrow = mysqli_fetch_array($resoldpic)) {
        $pather = $picrow["tool_pic_path"];
    }

    $updatetoolsql = "UPDATE tool_all_table SET 
        tool_brand = '$branddef', 
        tool_name = '$toolname', 
        tool_model = '$defmodel', 
        tool_type = '$ttype', 
        tool_desc = '$desc',
        tool_pic_path = '$pather'
        WHERE tool_all_ID = '$idall'";

    $res = $conn->query($updatetoolsql);

    echo "</br>" . mysqli_error($conn);

    if ($res) {

        // $sccupdcon = "<script type='text/javascript'> alert('Tool Update Successfully') </script>";

        echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
        exit();
    } else {

        // $errupdcon = "<script type='text/javascript'> alert('Error : Tool Update Cancelled') </script>";
    }
} else {
    if (move_uploaded_file($_FILES["picupload"]["tmp_name"], $picpath . $newname)) {
        echo "The file " . htmlspecialchars(basename($_FILES["picupload"]["name"])) . " has been uploaded.";
        $pather = $picpath . $newname;
        // echo $pather;

        $updatetoolsql = "UPDATE tool_all_table SET 
            tool_brand = '$branddef', 
            tool_name = '$toolname', 
            tool_model = '$defmodel', 
            tool_type = '$ttype', 
            tool_desc = '$desc',
            tool_pic_path = '$pather'
            WHERE tool_all_ID = '$idall'";

        $res = $conn->query($updatetoolsql);

        echo "</br>" . mysqli_error($conn);

        if ($res) {

            // $sccupdcon = "<script type='text/javascript'> alert('Tool Update Successfully') </script>";

            echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
            exit();
        } else {

            // $errupdcon = "<script type='text/javascript'> alert('Error : Tool Update Cancelled') </script>";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
