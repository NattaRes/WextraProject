<?php
include("../connectdb.php");

$inputID = $_POST['toolidinput'];
$toolname = $_POST['toolnameinput'];
$branddef = $_POST['branddef'];
$defmodel = $_POST['defmodel'];
$ttype = $_POST['categoryinput'];
$desc = $_POST['description'];

$databasecheck = "SELECT tool_all_ID FROM tool_all_table
    WHERE tool_all_ID = '$inputID'";
$resdbch = $conn->query($databasecheck);
$countdbch = mysqli_num_rows($resdbch);

if ($countdbch < 1) {

    $picpath = "../image/tools/";
    $fileone = $picpath . basename($_FILES["picupload"]["name"]);
    $uploadint = 1;
    $imgfiletype = strtolower(pathinfo($fileone, PATHINFO_EXTENSION));
    $filexplode = explode(".", $_FILES["picupload"]["name"]);
    $newname = $inputID . '.' . end($filexplode);

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

        $pather = "../image/tools/tool_default.png";

        $addtoolsql = "INSERT INTO tool_all_table 
            (tool_all_ID, tool_brand, tool_name, tool_model, tool_type, tool_desc, tool_pic_path) 
            VALUES ('$inputID', '$branddef', '$toolname', '$defmodel', '$ttype', '$desc', '$pather')";
        $res = $conn->query($addtoolsql);

        if ($res) {

            echo "<script type='text/javascript'> alert('Add Tool Successfully') </script>";
            echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
            exit();
        } else {

            echo $conn->error;
            // echo "<script type='text/javascript'> alert('Error : " . $conn->error ."') </script>";
            echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
            exit();
        }
    } else {
        if (move_uploaded_file($_FILES["picupload"]["tmp_name"], $picpath . $newname)) {
            echo "The file " . htmlspecialchars(basename($_FILES["picupload"]["name"])) . " has been uploaded.";
            $pather = $picpath . $newname;
            // echo $pather;

            $addtoolsql = "INSERT INTO tool_all_table 
                (tool_all_ID, tool_brand, tool_name, tool_model, tool_type, tool_desc, tool_pic_path) 
                VALUES ('$inputID', '$branddef', '$toolname', '$defmodel', '$ttype', '$desc', '$pather')";
            $res = $conn->query($addtoolsql);

            if ($res) {

                echo "<script type='text/javascript'> alert('Add Tool Successfully') </script>";
                echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
                exit();
            } else {

                echo $conn->error;
                // echo "<script type='text/javascript'> alert('Error : " . $conn->error ."') </script>";
                echo "<script type='text/javascript'>location.href='../adminsite/ListTools.php?cateinput=all&sfi=all&sinput=';</script>";
                exit();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {

    echo "This tool ID is already exist : " . $inputID;
}
