<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />

</head>

<body>

    <?php

    include("../connectdb.php");

    $uid = $_COOKIE["userck"];

    $usersql = "SELECT * FROM user 
        INNER JOIN faculty_table ON user.faculty = faculty_table.faculty
        INNER JOIN level_table ON user.level = level_table.level
        WHERE UID = '$uid'";

    $queuser = $conn->query($usersql);

    while ($rowuser = mysqli_fetch_array($queuser)) {
        $username = $rowuser["username"];
        $email = $rowuser["email"];
        $phone = $rowuser["phonenum"];
        $profilepic = $rowuser["profile_pic_path"];
        $faculty = $rowuser["faculty_name"];
        $level = $rowuser["level_name"];
    }

    ?>

    <div style="margin-top: 10%;">

        <div class="container bg-white mt-5 mb-5" style="border-radius: 25px;">
            <div class="row">
                <div style="margin-left: 15%;">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3" style="margin-top: 15%; color:#717171">
                            <h4>โปรไฟล์</h4>
                        </div>
                        <img style="border-radius: 20px;" width="150px" src="<?php echo $profilepic; ?>">
                    </div>
                </div>

                <div class="col-md-5" style="margin-left: 20%;">
                    <div>

                        <div style="margin-top: 15%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">ชื่อ </label>
                            <label style="margin-left: 24%; font-size: 18px; color: #7E7C7C; 
                            background-color: white; border-radius: 9px; width: 280px; height: 32px; text-align: center;
                            box-shadow: 0px 1px 4px 4px rgba(0, 0, 0, 0.25);"><?php echo $username; ?></label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">รหัสนักศึกษา </label>
                            <label style="margin-left: 7%; font-size: 18px; color: #7E7C7C; 
                            background-color: white; border-radius: 9px; width: 280px; height: 32px; text-align: center;
                            box-shadow: 0px 1px 4px 4px rgba(0, 0, 0, 0.25);"><?php echo $uid; ?></label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; margin-right:8%; font-size: 18px; color: #7E7C7C;">คณะ </label>
                            <label style="margin-left: 13%; font-size: 18px; color: #7E7C7C; 
                            background-color: white; border-radius: 9px; width: 280px; height: 32px; text-align: center;
                            box-shadow: 0px 1px 4px 4px rgba(0, 0, 0, 0.25);"><?php echo $faculty; ?></label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">ระดับ </label>
                            <label style="margin-left: 20%; font-size: 18px; color: #7E7C7C; 
                            background-color: white; border-radius: 9px; width: 280px; height: 32px; text-align: center;
                            box-shadow: 0px 1px 4px 4px rgba(0, 0, 0, 0.25);"><?php echo $level; ?></label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">อาจารย์ที่ปรึกษา </label>
                            <label style="margin-left: 2%; font-size: 18px; color: #7E7C7C; 
                            background-color: white; border-radius: 9px; width: 280px; height: 32px; text-align: center;
                            box-shadow: 0px 1px 4px 4px rgba(0, 0, 0, 0.25);">นายสม ใจดี</label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">อีเมล </label>
                            <label style="margin-left: 20%; font-size: 18px; color: #7E7C7C; 
                            background-color: white; border-radius: 9px; width: 280px; height: 32px; text-align: center;
                            box-shadow: 0px 1px 4px 4px rgba(0, 0, 0, 0.25);"><?php echo $email; ?></label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">เบอร์โทรศัพท์ </label>
                            <label style="margin-left: 6.5%; font-size: 18px; color: #7E7C7C; 
                            background-color: white; border-radius: 9px; width: 280px; height: 32px; text-align: center;
                            box-shadow: 0px 1px 4px 4px rgba(0, 0, 0, 0.25);"><?php echo $phone; ?></label>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="editprofile.php">
                                <button style="background: #D9D9D9; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 9px; width: 100px;
                                    height: 45px; border: none;color: #7A7A7A; margin-bottom: 10%; margin-left: 71%;" type="button">แก้ไข
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


</body>

</html>