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

        $toolspecsql = "SELECT * FROM tool_specific_table
			WHERE tool_all_ID = '$toolid'";
        $resta = $conn->query($toolspecsql);
        $countresta = mysqli_num_rows($resta);

        $novacsql = "SELECT * FROM tool_specific_table
			WHERE tool_all_ID = '$toolid'
			AND tool_status = 1";
        $resconovac = $conn->query($novacsql);
        $countresnovac = mysqli_num_rows($resconovac);

        ?>
        <form action="../universalbackend/addtocart.php" method="POST" onsubmit='redirect();return false;'>

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
                        <div style="margin-top: -10%; margin-bottom:5%">
                            <!-- <span class="dot"></span>
                            <lebel style="color: green; margin-left: 5%; font-size: 20px; font-weight: bold;">ว่าง</lebel> -->
                        </div>
                        <div style="margin-bottom:10%; margin-top: 5%;">
                            <h5 style="float: left; margin-left: 8%;color: #6e6e6e;">จำนวน :</h5>
                            <h5 style="float: left; margin-left: 3%;color: #6e6e6e; margin-right:15%;"><?php echo $countresta; ?> ตัว</h5>
                            <h5 style="float: left; margin-left: 5%; color: #6e6e6e;">เหลือ :</h5>
                            <h5 style="float: left; margin-left: 3%;color: #6e6e6e;"><?php echo $countresnovac; ?> ตัว</h5>
                        </div>
                       

                        <div style="margin-top: 20%; margin-bottom:20%;">
                            <lebel style="color: #6e6e6e; margin-left: 5%; margin-right:10%; font-size: 20px; ">จำนวน</lebel>
                            <input name="toolidall" type="hidden" value="<?php echo $toolid; ?>" />
                            <input name="quantinum" type="number" min="1" max="999" style="width:35%;  margin-left: 2%; margin-right:10%;" value="1" />
                            <input name="submit" type="image" src="../image/icon/shopping-cart (2).png" alt="Submit" style=" height: 45px; width: 45px; margin-bottom:-5%;" />
                            <!-- <a href="../universalbackend/addtocart.php?toolidall=<?php echo $toolid; ?>">
                            <img src="../image/icon/shopping-cart (2).png" alt="" style=" height: 45px; width: 45px; ">
                        </a> -->
                        </div>

                    </div>

                    <div class="col-md-5" style="margin-left: 10%;">
                        <div>

                            <div style="margin-top: 15%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #6e6e6e; font-weight: bold;">ชื่อ :
                                </label>
                                <label style="font-size: 18px; color: #6e6e6e; text-align: left; "><?php echo $tname; ?></label>
                            </div>

                            <div style="margin-top: 1%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #6e6e6e; font-weight: bold;">รุ่น
                                    : </label>
                                <label style="font-size: 18px; color: #6e6e6e; text-align: left; "><?php echo $tmodel; ?>
                                </label>
                            </div>

                            <div style="margin-top: 1%;">
                                <label style="margin-left: 5%; font-size: 18px; color: #6e6e6e; font-weight: bold;">ยี่ห้อ
                                    : </label>
                                <label style="font-size: 18px; color: #6e6e6e; text-align: left;"><?php echo $brandname; ?>
                                </label>
                            </div>

                            <div>
                                <label style="margin-left: 5%; margin-right:0%;font-size: 18px; color: #6e6e6e; font-weight: bold;">รายละเอียด :
                                </label>
                                <label style="font-size: 18px; color: #6e6e6e; text-align: left;">
                                <?php echo $desc; ?>
                                </label>
                            </div>

                            <!--
                        <div class="mt-5 text-center">
                            <a href="Alltools.php?toolidall=<?php echo $toolid; ?>">
                                <button style="background: #D9D9D9; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 9px; width: 100px;
                                height: 45px; border: none;color: #7A7A7A; margin-bottom: 10%; margin-left: 71%;"
                                    type="button">กลับ
                                </button>
                            </a>
                        </div>
                        -->
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>

    </html>
</body>