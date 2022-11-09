<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailwind CSS Edit Post UI with form plugins</title>
    <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="deleteform.css">

</head>

<body>

    <?php

    include("../connectdb.php");

    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $postID = $parts['postid'];

    $tablequery = "SELECT * FROM post_table 
        INNER JOIN user ON post_table.UID = user.UID
        WHERE post_ID = '$postID'";

    $res = $conn->query($tablequery);

    while ($row = mysqli_fetch_array($res)) {
        $title = $row["post_title"];
        $date = $row["post_time"];
        $desc = $row["post_desc"];
        $pic_path = $row["post_pic_path"];
        $uid = $row["UID"];
        $username = $row["username"];
    }

    ?>

    <!-- create Post -->
    <div style="margin-top: 10%;">
        <div>
            <div class="mb-4">
                <h1 style="font-size: 30px; margin-left:10%;">
                    ลบโพสต์
                </h1>
            </div>

            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10" style="width:80%; margin-left:10%; margin-right:20%; height:100%">
            <a href="Post.php?sfi=all&sinput=" >
            <i class='fa fa-times' style="float:right; font-size:30px; margin-top:0%;">
            </i>
            </a>    
            <form method="POST" action="../adminbackend/delpost.php?poid=<?php echo $postID; ?>">
                    <!-- Text Input -->
                    <div style="float: left ;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            หัวข้อ :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $title; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            วันที่ :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $date; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom:1%;">
                        <label style="font-size: 18px;">
                            ภาพ :
                        </label>
                        <label style="font-size: 18px;">
                            <img src="" alt="">
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            คำอธิบาย :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $desc; ?>
                        </label>
                    </div>

                    <div class="flex items-center justify-start mt-4 gap-x-2">
                        <button type="submit" style="width:150px;
                                height:40px;
                                border:none;
                                font-size: 20px;
                                border-radius:5px;
                                margin-left:85%;
                                background: #015C92;              
                                color:#fff;
                                cursor:pointer;">
                            ยืนยัน
                        </button>
                    </div>
                </form>
              
            </div>
        </div>
    </div>

</body>

</html>