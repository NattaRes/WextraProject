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
    <!-- create Post -->
    <div style="margin-top: 10%;">
        <div>
            <div class="mb-4">
                <h1 style="font-size: 30px; margin-left:10%;">
                    ลบข้อมูล
                </h1>
            </div>

            <?php

            include("../connectdb.php");

            $url = $_SERVER['REQUEST_URI'];

            // echo $url;

            $partscrap = parse_url($url);

            parse_str($partscrap['query'], $parts);

            $toolidall = $parts['toolidall'];

            $tablequery = "SELECT * FROM tool_all_table 
            INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
            INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type 
            WHERE tool_all_ID = '$toolidall'";

            $res = $conn->query($tablequery);

            while ($row = mysqli_fetch_array($res)) {
                $toolid = $row['tool_all_ID'];
                $brandname = $row['brand_name'];
                $tname = $row['tool_name'];
                $tmodel = $row['tool_model'];
                $typename = $row['type_name'];
                $desc = $row['tool_desc'];
            }

            ?>

            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10" style="width:80%; margin-left:10%; margin-right:20%; height:100%">
            <a href="ManageUser.php?sfi=all&sinput=" >
            <i class='fa fa-times' style="float:right; font-size:30px; margin-top:0%;">
            </i>
            </a>
            <form method="GET" action="../adminbackend/deltools.php">
                    <!-- Text Input -->
                    <div style="float: left ;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            ชื่อ :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $tname; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            ID :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $toolid; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom:1%;">
                        <label style="font-size: 18px;">
                            หมวดหมู่ :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $typename; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            ยี่ห้อ :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $brandname; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            รุ่น :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $tmodel; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            รายละเอียด :
                        </label>
                        <label style="font-size: 18px;">
                            <?php echo $desc; ?>
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            ID ของเครื่องมือ :
                        </label>
                        <input style="width: 30%; border:1px solid black; border-radius:5px;" type="text" name="idconfirm" id="idconfirm" placeholder="กรอก ID" required />
                        <input type="hidden" name="checker" id="checker" value="<?php echo $toolidall; ?>" />
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