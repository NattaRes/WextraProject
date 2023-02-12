<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="cartui.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

</head>

<body>

    <?php

    include("../connectdb.php");

    $uid = $_COOKIE["userck"];

    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $queid = $parts["queid"];

    $queselectsql = "SELECT * FROM queue_table 
        INNER JOIN user ON user.UID = queue_table.approver_UID
        WHERE que_ID = '$queid'";

    $resque = $conn->query($queselectsql);

    while ($rowresq = mysqli_fetch_array($resque)) {
        $quenum = $rowresq["que_ID"];
        $queowner = $rowresq["que_owner_UID"];
        $aprname = $rowresq["username"];
        $qsdate = $rowresq["s_date"];
        $qedate  = $rowresq["e_date"];
        $qdesc = $rowresq["que_desc"];
        $qstatus = $rowresq["queue_status"];
    }

    $s_date = date_create($qsdate);

    $e_date = date_create($qedate);

    ?>

    <div class="container mt-10 p-3 cart" style="margin-top: 9%; background-color: #F6F6F6; border-radius: 30px; margin-bottom: 4%;">
        <div class="row-md-4">
            <div class="d-flex justify-content-between align-items-center" style="color: #7E7C7C;  margin-top: 2%;">

                <h2 style="margin-left: 7.5%; font-weight: bold;">หมายเลขคิว <?php echo $quenum; ?></h2>
                <span class="credit-card-label" style="font-size: 18px; color: #7E7C7C; font-weight: bold; margin-left: 50%;">วันที่รับอุปกรณ์ :</span>
                <span class="credit-card-label" style="font-size: 18px; color: #7E7C7C; font-weight: bold; margin-right: 5%;"><?php echo date_format($s_date, "d/m/Y"); ?></span>

            </div>

            <div class="payment-info">
                <?php

                $usersql = "SELECT * FROM user 
                    INNER JOIN faculty_table ON user.faculty = faculty_table.faculty
                    INNER JOIN level_table ON user.level = level_table.level
                    WHERE UID = '$queowner'";

                $resuser = $conn->query($usersql);

                while ($rowuser = mysqli_fetch_array($resuser)) {
                    $username = $rowuser["username"];
                    $email = $rowuser["email"];
                    $phone = $rowuser["phonenum"];
                    $faculty = $rowuser["faculty_name"];
                    $level = $rowuser["level_name"];
                }

                ?>
                <div class="d-flex justify-content-between align-items-center" style="color: #6e6e6e; font-size: 20px;">
                    <span style="margin-left: 5%;">รายละเอียดผู้ขอยืม</span>
                    <!--<a href="">
                        <span><img src="../image/icon/shredder.png" alt="" style="width: 10%; height:10%; margin-left: 80%;" /></span>
                    </a>-->
                </div><span class="type d-block mt-3 mb-1"></span>
                <div>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #6e6e6e;">ชื่อ :</label>
                    <label class="credit-card-label" style="margin-right:26%; font-size: 18px; color: #6e6e6e;"><?php echo $username; ?></label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;">รหัสนักศึกษา:</label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e; "><?php echo $uid; ?></label>
                </div>
                <div>
                    <label class="credit-card-label" style="margin-left: 5%; margin-right: 22.4%; font-size: 18px; color: #6e6e6e;">คณะ : <?php echo $faculty; ?></label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;">ระดับ : <?php echo $level; ?></label>
                </div>
                <div><label class="credit-card-label" style="margin-left: 5%; margin-right: 11%;font-size: 18px; color: #6e6e6e;">Email : <?php echo $email; ?></label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;">เบอร์ติดต่อ : <?php echo $phone; ?></label>
                </div>
                <div><label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #6e6e6e;">วันที่ยืม :</label>
                    <label class="credit-card-label" style="margin-right: 26.2%; font-size: 18px; color: #6e6e6e;"><?php echo date_format($s_date, "d/m/Y"); ?></label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;">วันที่คืน : </label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;"><?php echo date_format($e_date, "d/m/Y"); ?></label>
                </div>
                <div>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #6e6e6e;">ผู้อนุมัติ :</label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;"><?php echo $aprname; ?></label>
                </div>


                <div><label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #6e6e6e;">หมายเหตุ : </label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;"><?php echo $qdesc; ?></label>
                </div>
            </div>
            <div>
                <hr noshade="noshade" style="color: black;">
                <div class="container bootstrap snippets bootdey">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box no-header clearfix" style="border-radius: 22px; box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25);">
                                <div class="main-box-body clearfix">
                                    <div class="table-responsive">
                                        <table class="table user-list">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span>ลำดับ</span></th>
                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span>ชื่ออุปกรณ์</span></th>
                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span>จำนวน</span></th>
                                                    <th>&nbsp;</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                $ledgersql = "SELECT * FROM ledger_table
                                                    INNER JOIN tool_all_table ON ledger_table.tool_all_ID = tool_all_table.tool_all_ID
                                                    INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type
                                                    INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
                                                    WHERE que_ID = '$queid'";

                                                $resledger = $conn->query($ledgersql);

                                                $inarr = array();

                                                $rowlednum = 1;

                                                $rowcount = 0;
                                                $itemcount = 0;

                                                while ($row = mysqli_fetch_array($resledger)) {

                                                    $toolID = $row["tool_all_ID"];
                                                    $countquid = $row["que_ID"];

                                                    $ledgercountsql = "SELECT * FROM ledger_table
                                                        WHERE tool_all_ID = '$toolID'
                                                        AND que_ID = '$countquid'";

                                                    $resledcount = $conn->query($ledgercountsql);

                                                    $counterledger = mysqli_num_rows($resledcount);

                                                    if (!in_array($toolID, $inarr)) {

                                                ?>

                                                        <tr>
                                                            <td width="20%">
                                                                <h5 style="text-align: center; color: #6e6e6e;"><?php echo $rowlednum; ?></h5>
                                                            </td>
                                                            <td width="60%">
                                                                <img src="<?php echo $row["tool_pic_path"]; ?>" alt="" style="max-width: 20%; border-radius: 22px;">
                                                                <span class="user-link"><?php echo $row["brand_name"] . " " . $row["tool_name"]; ?></span>
                                                                <span class="user-subhead">รุ่น <?php echo $row["tool_model"]; ?></span>
                                                            </td>
                                                            <td>
                                                                <span class="user-link1"><?php echo $counterledger; ?></span>
                                                            </td>
                                                            <th>&nbsp;</th>

                                                        </tr>

                                                <?php

                                                        $rowcount++;
                                                        $itemcount += $counterledger;
                                                        $rowlednum++;
                                                        array_push($inarr, $toolID);
                                                    }
                                                }

                                                ?>

                                                <tr>

                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span>รวมทั้งหมด</span></th>
                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span><?php echo $rowcount; ?> รายการ</span></th>
                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span><?php echo $itemcount; ?> ชิ้น</span></th>
                                                    <th>&nbsp;</th>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>