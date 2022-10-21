<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailwind CSS Edit Post UI with form plugins</title>
    <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
    <link rel="stylesheet" href="deleteform.css">

</head>

<body>
    <!-- create Post -->
    <div style="margin-top: 10%;">
        <div>
            <div class="mb-4">
                <h1 style="font-size: 30px; margin-left:15%;">
                    ลบผู้ใช้
                </h1>
            </div>

            <?php

            include("../connectdb.php");

            $url = $_SERVER['REQUEST_URI'];

            // echo $url;

            $partscrap = parse_url($url);

            parse_str($partscrap['query'], $parts);

            $uid = $parts['uid'];

            $tablequery = "SELECT * FROM user
                INNER JOIN role_table ON user.role = role_table.role
                WHERE UID = '$uid'";

            $userfetch = $conn->query($tablequery);

            while ($row = mysqli_fetch_array($userfetch)) {

                $userid = $row['UID'];
                $name = $row['username'];
                $phone = $row['phonenum'];
            }

            ?>

            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10" style="width:70%; margin-left:15%; margin-right:20%; height:100%">
                <form method="GET" action="../adminbackend/deluser.php">
                    <!-- Text Input -->
                    <div style="float: left ;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            ชื่อ :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $name; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            รหัสนักศึกษา :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $userid; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom:1%;">
                        <label style="font-size: 18px;">
                            เบอร์โทรศัพท์ :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $phone; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom:1%;">
                        <label style="font-size: 18px;">
                            ชั้นปีการศึกษา :
                        </label>
                        <label style="font-size: 18px;">
                            1
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom:1%;">
                        <label style="font-size: 18px;">
                            คณะ :
                        </label>
                        <label style="font-size: 18px;">
                            xxxx
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom:1%;">
                        <label style="font-size: 18px;">
                            สาขา :
                        </label>
                        <label style="font-size: 18px;">
                            xxx
                        </label>
                        <input type="hidden" name="uid" id="uid" value="<?php echo $userid; ?>" />
                    </div>
                    <div class="flex items-center justify-start mt-4 gap-x-2">
                        <button type="submit" style="width:150px;
                                height:40px;
                                border:none;
                                font-size: 20px;
                                border-radius:5px;
                                margin-left:80%;
                                background: #015C92;              
                                color:#fff;
                                cursor:pointer;">
                            ยืนยัน
                        </button>

                    </div>
                </form>
                <a href="ManageUser.php?sfi=all&sinput=">
                    <button style="width:150px;
                            height:40px;
                            border:none;
                            font-size: 20px;
                            border-radius:5px;
                            background:rgba(192, 0, 0, 0.777);	
                            color:#fff;
                            cursor:pointer;">
                        ยกเลิก
                    </button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>