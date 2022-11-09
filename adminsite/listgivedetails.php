<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="detailborrowui.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

</head>

<body>
    <?php

    include("../connectdb.php");

    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $queid = $parts["queid"];

    $quebrwsql = "SELECT * FROM queue_table
        INNER JOIN user ON user.UID = queue_table.approver_UID
        WHERE que_ID = '$queid'";
    $resquebrw = $conn->query($quebrwsql);

    while ($quedet = mysqli_fetch_array($resquebrw)) {
        $queowner = $quedet["que_owner_UID"];
        $aprname = $quedet["username"];
        $qsdate = $quedet["s_date"];
        $qedate  = $quedet["e_date"];
        $qdesc = $quedet["que_desc"];
        $qstatus = $quedet["queue_status"];
    }

    $s_date = date_create($qsdate);

    $e_date = date_create($qedate);

    ?>
    <div style="margin-top: 6%; margin-left: 1%;">
        <h2 style="font-size: 30px; margin-left: 7%;  margin-right: 70%; color: black; "> รายการคืน </h2>
        <div class="container mt-10 p-3 cart" style="margin-top: 1%; background-color: #F6F6F6; border-radius: 30px; margin-bottom: 4%;">
            <div class="payment-info">
                <div class="d-flex justify-content-between align-items-center" style="color: black;  font-size: 20px;">
                    <span style="margin-left: 5%;">รายละเอียดผู้ขอยืม</span>
                </div><span class="type d-block mt-3 mb-1"></span>
                <div>
                    <?php

                    $usersql = "SELECT * FROM user WHERE UID = '$queowner'";

                    $resuser = $conn->query($usersql);

                    while ($rowuser = mysqli_fetch_array($resuser)) {
                        $username = $rowuser["username"];
                        $email = $rowuser["email"];
                        $phone = $rowuser["phonenum"];
                    }

                    ?>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 20px; color: black; ">หมายเลคคิว :</label>
                    <label class="credit-card-label" style="font-size: 20px; margin-left: 1%; color: black; "><?php echo $queid; ?></label>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 20px; color: black; ">ชื่อ :</label>
                    <label class="credit-card-label" style="font-size: 20px; margin-left: 1%; color: black; "><?php echo $username; ?></label>
                    <label class="credit-card-label" style="margin-left: 8%; font-size: 20px; color: black; ">รหัสนักศึกษา:</label>
                    <label class="credit-card-label" style="margin-left: 1%; font-size: 20px; color: black; "><?php echo $queowner; ?></label>

                </div>
                <div>


                </div>
                <div>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 20px; color: black; ">คณะ : กระทรวงเวทย์มนต์</label>
                    <label class="credit-card-label" style="margin-left: 13%; font-size: 20px; color: black; ">สาขา : เทคโนโลยีดิจิทัล</label>
                </div>
                <div><label class="credit-card-label" style="margin-left: 5%; font-size: 20px;color: black; ">Email : <?php echo $email; ?></label>
                    <label class="credit-card-label" style="margin-left: 10.5%;font-size: 20px; color: black; ">เบอร์ติดต่อ : <?php echo $phone; ?></label>
                </div>
                <div><label class="credit-card-label" style="margin-left: 5%; font-size: 20px; color: black; ">วันที่คืน :</label>
                    <label class="credit-card-label" style="font-size: 20px; color: black;"><?php echo date_format($e_date, "d/m/Y"); ?></label>
                    <label class="credit-card-label" style="margin-left: 20.5%; font-size: 20px; color: black;">หมายเหตุ :</label>
                    <label class="credit-card-label" style="font-size: 20px; color: black;"><?php echo $qdesc; ?></label>
                </div>
                <div>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 20px; color: black;">ใบเสร็จ :</label>
                    <button class="onbuttonprint" type="button">ดาวน์โหลด</button>
                </div>
            </div>
            <hr noshade="noshade" style="color: black; margin-top: 5%;">

            <div>
                <div style="margin-top: 2%;">
                    <lebel style="font-size: 25px; margin-left: 2%; color: black;"> รายการอุปกรณ์</lebel>
                </div>
                <div class="container bootstrap snippets bootdey">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box no-header clearfix" style="box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25); margin-top: 2%;">
                                <div class="main-box-body clearfix">
                                    <div class="table-responsive">
                                        <table class="table user-list" style="margin-bottom: 0%;">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194); "><span>ลำดับ</span></th>
                                                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>ชื่ออุปกรณ์</span></th>
                                                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>รหัสครุภัณฑ์</span></th>
                                                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>สภาพเครื่องมือ</span></th>

                                                </tr>
                                            </thead>
                                            <form action="../adminbackend/returtool.php" method="POST">
                                                <input type="hidden" name="queid" value="<?php echo $queid; ?>" />
                                                <tbody>
                                                    <?php

                                                    $brwlistsql = "SELECT * FROM ledger_table
                                                        INNER JOIN tool_all_table ON ledger_table.tool_all_ID = tool_all_table.tool_all_ID
                                                        INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type
                                                        INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
                                                        WHERE que_ID = '$queid'";
                                                    $resbrwlist = $conn->query($brwlistsql);

                                                    $itemcount = 0;

                                                    $rownum = 1;

                                                    while ($ledgerlist = mysqli_fetch_array($resbrwlist)) {

                                                        $toolidall = $ledgerlist["tool_all_ID"];;
                                                        $ledgerID = $ledgerlist["Ledger_num"];

                                                    ?>
                                                        <tr>
                                                            <td style="border: 2px solid rgb(194, 194, 194); ">
                                                                <h5 style="text-align: center; color: black; "><?php echo $rownum; ?></h5>
                                                            </td>
                                                            <td width="40%" style="border: 2px solid rgb(194, 194, 194); ">
                                                                <img src="<?php echo $ledgerlist["tool_pic_path"]; ?>" alt="" style="max-width: 30%; border-radius: 22px;">
                                                                <span class="user-link" style="color: black;"><?php echo $ledgerlist["brand_name"] . " " . $ledgerlist["tool_name"]; ?></span>
                                                                <span class="user-subhead" style="color: black;">รุ่น <?php echo $ledgerlist["tool_model"]; ?></span>
                                                            </td>
                                                            <input type="hidden" name="ledgerID[]" value="<?php echo $ledgerID; ?>" />
                                                            <td style="border: 2px solid rgb(194, 194, 194); ">
                                                                <span class="user-link1" style="color: black;"><?php echo $ledgerlist["tool_spec_ID"]; ?></span>
                                                            </td>
                                                            <input type="hidden" name="toolspec[]" value="<?php echo $ledgerlist["tool_spec_ID"]; ?>" />
                                                            <td style="border: 2px solid rgb(194, 194, 194); ">
                                                                <select name="tstat[]" id="mySelect" style="margin-left:25%; height:100%; width: 50%; font-size:20px; border-radius:5px;" required>
                                                                    <?php

                                                                    $toolstatsql = "SELECT * FROM tool_status_table
                                                                        WHERE tool_status != 2
                                                                        ORDER BY tool_status ASC";
                                                                    $resstat = $conn->query($toolstatsql);

                                                                    $statcount = 1;

                                                                    while ($rowstat = mysqli_fetch_array($resstat)) {

                                                                    ?>
                                                                        <option value="<?php echo $rowstat["tool_status"]; ?>"><?php echo $statcount . ". " . $rowstat["t_status"]; ?></option>
                                                                    <?php

                                                                        $statcount++;
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $itemcount++;
                                                        $rownum++;
                                                    }

                                                    ?>
                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; color: black; font-size: 18px;  border-bottom: 2px solid rgb(194, 194, 194); border-left: 0px solid rgb(194, 194, 194);"><span></span></th>
                                                        <th style="text-align: right; color: black; font-weight: bold; font-size: 18px; border-bottom: 2px solid rgb(194, 194, 194);border-left: 0px solid rgb(194, 194, 194);"><span>รวมทั้งหมด</span></th>
                                                        <th style="text-align: center; color: black; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span><?php echo $itemcount; ?></span></th>
                                                        <th style="text-align: center; color: black; font-size: 18px;  border-bottom: 2px solid rgb(194, 194, 194); border-right: 2px solid rgb(194, 194, 194);"><span></span></th>

                                                    </tr>
                                                </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="onbutton" type="submit">ยืนยันคืนอุปกรณ์</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top:30%;">
        </div>
</body>

</html>