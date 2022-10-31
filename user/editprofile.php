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

    $usersql = "SELECT * FROM user WHERE UID = '$uid'";

    $queuser = $conn->query($usersql);

    while ($rowuser = mysqli_fetch_array($queuser)) {
        $username = $rowuser["username"];
        $email = $rowuser["email"];
        $phone = $rowuser["phonenum"];
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
                        <img style="border-radius: 20px;" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold">
                            <button style="background: #D9D9D9; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 9px; width: 150px;
                                height: 45px; border: none;color: #7A7A7A;" type="button">เปลี่ยนรูปภาพ</button>
                        </span>
                    </div>
                </div>

                <div class="col-md-5" style="margin-left: 20%;">
                    <div>

                        <form action="../universalbackend/accedit.php" method="POST">

                            <div style="margin-top: 15%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">ชื่อ </label>
                                <input name="iname" type="text" placeholder="Username" style="margin-left: 24%; font-size: 18px; color: #7E7C7C; 
                                background-color: #D9D9D9; border-radius: 9px; width: 280px; height: 32px; text-align: center; border: none;" value="<?php echo $username; ?>" required />
                            </div>
                            <div style="margin-top: 1%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">รหัสนักศึกษา </label>
                                <input type="text" placeholder="User ID" style="margin-left: 7%; font-size: 18px; color: #7E7C7C; 
                                background-color: #D9D9D9; border-radius: 9px; width: 280px; height: 32px; text-align: center;border: none;" value="<?php echo $uid; ?>" readonly />
                            </div>
                            <div style="margin-top: 1%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">สำนักวิชา </label>
                                <input type="text" placeholder="สำนัก" style="margin-left: 13%; font-size: 18px; color: #7E7C7C; 
                                background-color: #D9D9D9; border-radius: 9px; width: 280px; height: 32px; text-align: center;border: none;">
                            </div>
                            <div style="margin-top: 1%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">สาขา </label>
                                <input type="text" placeholder="สาขา" style="margin-left: 20%; font-size: 18px; color: #7E7C7C; 
                                background-color: #D9D9D9; border-radius: 9px; width: 280px; height: 32px; text-align: center;border: none;">
                            </div>
                            <div style="margin-top: 1%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">อาจารย์ที่ปรึกษา </label>
                                <input type="text" placeholder="Username" style="margin-left: 2%; font-size: 18px; color: #7E7C7C; 
                                background-color: #D9D9D9; border-radius: 9px; width: 280px; height: 32px; text-align: center;border: none;">
                            </div>
                            <div style="margin-top: 1%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">อีเมล </label>
                                <input name="inemail" type="text" placeholder="E-mail" style="margin-left: 20%; font-size: 18px; color: #7E7C7C; 
                                background-color: #D9D9D9; border-radius: 9px; width: 280px; height: 32px; text-align: center;border: none;" value="<?php echo $email; ?>" required />
                            </div>
                            <div style="margin-top: 1%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">เบอร์โทรศัพท์ </label>
                                <input name="inphone" type="text" placeholder="Phone number" style="margin-left: 6.5%; font-size: 18px; color: #7E7C7C; 
                                background-color: #D9D9D9; border-radius: 9px; width: 280px; height: 32px; text-align: center;border: none;" value="<?php echo $phone; ?>" required />
                            </div>

                            <div class="mt-5 text-center">
                                <button style="background: #019214; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 9px; width: 100px;
                                height: 45px; border: none;color: #ffffff; margin-bottom: 10%; margin-left: 50%;" type="submit">ยืนยัน</button>
                        </form>
                        <a href="Profile.php">
                            <button style="background: #b71010; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 9px; width: 100px;
                                    height: 45px; border: none;color: #ffffff; margin-bottom: 10%; margin-left: 0%;" type="button">ยกเลิก
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>