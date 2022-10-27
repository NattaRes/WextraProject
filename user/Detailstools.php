<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="detailtools.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />

</head>

<body>
    <html>
    <div style="margin-top: 10%;">

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
            $pic_path = $row['tool_pic_path'];
        }

        ?>

        <div class="container bg-white mt-5 mb-5" style="border-radius: 25px;">
            <div class="row">
                <div style="margin-left: 10%;">
                    <div class=" flex-column text-center p-3 py-5">
                        <img style="width: 300px;
                        height: 200px;
                        border-radius: 22px;
                        background-color: #fff;
                        box-shadow: 0px 2px 4px 4px rgba(0, 0, 0, 0.25);
                        margin-top: 9%;" src="<?php echo $pic_path; ?>">
                    </div>
                    <div style="margin-bottom:15%">
                        <h5 style="float: left; margin-left: 5%;color: #7E7C7C;">จำนวน :</h5>
                        <h5 style="float: left; margin-left: 3%;color: #7E7C7C;">NONE ตัว</h5>
                        <h5 style="float: left; margin-left: 25%;color: #7E7C7C;">เหลือ</h5>
                        <h5 style="float: left; margin-left: 3%;color: #7E7C7C;">NONE ตัว</h5>

                    </div>
                    <div style="margin-top: 15%;">
                        <span class="dot"></span>
                        <label style="color: green; margin-left: 5%; margin-top: -10%; font-size: 18px; font-weight: bold;">ว่าง</label>
                        <button onclick="dec('amount')" style="margin-top: 4%; margin-left:11%; width: 10%;border-color: #d0cece;">-</button>
                        <input name="amount" type="text" value="0" style="width: 35%; text-align:center; ">
                        <button onclick="inc('amount')" style="width: 10%; border-color: #d0cece;">+</button>
                    </div>
                    <button class="onbutton" type="button">เพิ่มลงตะกร้า</button>

                </div>

                <div class="col-md-5" style="margin-left: 10%;">
                    <div>

                        <div style="margin-top: 15%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C; font-weight: bold;">ชื่อ :
                            </label>
                            <label style="font-size: 18px; color: #7E7C7C; text-align: left; "><?php echo $tname; ?></label>
                        </div>
                        <div>
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C; font-weight: bold;">รายละเอียด
                                : </label>
                            </label>
                        </div>
                        <div>
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C; text-align: left;">
                                ระบบการบัทึกภาพ (ภาพเคลื่อนไหว)IMAGE SIZE (MP4) 1440 x 1080 (30fps/12Mbps)
                            </label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C; font-weight: bold;">การบีบอัดไฟล์
                                : </label>
                            </label>
                        </div>
                        <div>
                            <label style="margin-left: 5%;font-size: 18px; color: #7E7C7C; text-align: left;"> AVCHD
                                Ver. 2.0 compliant / MPEG-4 AVC (H.264)
                            </label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C; font-weight: bold;">รูปแบบในการบันทึก
                                : </label>

                            </label>
                        </div>
                        <div>
                            <label style="margin-left: 5%;font-size: 18px; color: #7E7C7C; text-align: left;"> AVCHD,
                                MP4
                            </label>
                        </div>
                        <div style="margin-top: 1%;">
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C; font-weight: bold;">White
                                Balance (ค่าแสงสมดุลสีขาว) : </label>
                        </div>
                        <div>
                            <label style="margin-left: 5%; font-size: 18px; color: #7E7C7C; text-align: left;"> MODES
                                Auto WB, Daylight, Shade, Cloudy, Incandescent, Fluorescent, Flash, C.Tem (2500 to
                                9900K), C.Filter (G7 to M7 15-step, A7 to B7 15-step), Custom
                            </label>
                        </div>
                        <div class="mt-5 text-center">
                            <a href="Alltools.php?toolidall=<?php echo $toolid; ?>">
                                <button style="background: #D9D9D9; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 9px; width: 100px;
                                    height: 45px; border: none;color: #7A7A7A; margin-bottom: 10%; margin-left: 71%;" type="button">กลับ
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

    <script>
        function inc(element) {
            let el = document.querySelector(`[name="${element}"]`);
            el.value = parseInt(el.value) + 1;
        }

        function dec(element) {
            let el = document.querySelector(`[name="${element}"]`);
            if (parseInt(el.value) > 0) {
                el.value = parseInt(el.value) - 1;
            }
        }
    </script>

    </html>
</body>