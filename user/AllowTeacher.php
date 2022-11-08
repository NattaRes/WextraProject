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
    <div style="margin-top: 8%;">
        <lebel style="font-size: 30px; margin-left: 14%; color: white; margin-top: 20%;"> รายการอนุมัติ </lebel>
    </div>
    <div class="container mt-10 p-3 cart" style="margin-top: 1%; background-color: #F6F6F6; border-radius: 30px; margin-bottom: 4%; margin-left: 13%;">
        <div class="payment-info">
            <?php

            $usersql = "SELECT * FROM user WHERE UID = '$queowner'";

            $resuser = $conn->query($usersql);

            while ($rowuser = mysqli_fetch_array($resuser)) {
                $username = $rowuser["username"];
                $email = $rowuser["email"];
                $phone = $rowuser["phonenum"];
            }

            ?>
            <div class="d-flex justify-content-between align-items-center" style="color: #7E7C7C; font-size: 20px;">
                <span style="margin-left: 5%;">รายละเอียดผู้ขอยืม</span>
            </div><span class="type d-block mt-3 mb-1"></span>
            <div>
                <label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">ชื่อ :</label>
                <label class="credit-card-label" style="font-size: 18px; color: #7E7C7C;"><?php echo $username; ?></label>
            </div>
            <div>
                <label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">คณะ : กระทรวงเวทย์มนต์</label>
                <label class="credit-card-label" style="margin-left: 12.5%; font-size: 18px; color: #7E7C7C;">สาขา : เทคโนโลยีดิจิทัล</label>
            </div>
            <div><label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">Email : <?php echo $email; ?></label>
                <label class="credit-card-label" style="margin-left: 10%; font-size: 18px; color: #7E7C7C;">เบอร์ติดต่อ : <?php echo $phone; ?></label>
            </div>
            <div><label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">วันที่ยืม :</label>
                <label class="credit-card-label" style="font-size: 18px; color: #7E7C7C;"><?php echo date_format($e_date, "d/m/Y"); ?></label>
                <label class="credit-card-label" style="margin-left: 18.6%; font-size: 18px; color: #7E7C7C;">วันที่คืน : </label>
                <label class="credit-card-label" style="font-size: 18px; color: #7E7C7C;"><?php echo date_format($e_date, "d/m/Y"); ?></label>
            </div>
            <div>
                <label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">ผู้อนุมัติ :</label>
                <label class="credit-card-label" style="font-size: 18px; color: #7E7C7C;"><?php echo $aprname; ?></label>
            </div>


            <div><label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #7E7C7C;">หมายเหตุ : </label>
                <label class="credit-card-label" style="font-size: 18px; color: #7E7C7C;"><?php echo $qdesc; ?></label>
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

                                                <th style="text-align: center; color: #908F8F; font-weight: bold; font-size: 18px;"><span>ลำดับ</span></th>
                                                <th style="text-align: center; color: #908F8F; font-weight: bold; font-size: 18px;"><span>ชื่ออุปกรณ์</span></th>
                                                <th style="text-align: center; color: #908F8F; font-weight: bold; font-size: 18px;"><span>จำนวน</span></th>
                                                <th>&nbsp;</th>

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
                        <div class="flex items-center justify-start mt-4 gap-x-2">
                            <a href="../universalbackend/approverdecision.php?queid=<?php echo $queid; ?>&decis=ap">
                                <button style="width:150px;
                                        height:40px;
                                        border:none;
                                        font-size: 20px;
                                        border-radius:5px;
                                        margin-left:70%;
                                        background-color:rgba(25, 169, 0, 0.827);
                                        color:#fff;
                                        cursor:pointer;">
                                    อนุมัติ
                                </button>
                            </a>
                            <a href="../universalbackend/approverdecision.php?queid=<?php echo $queid; ?>&decis=cc">
                                <button type="reset" style="width:150px;
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
            </div>
        </div>
</body>

</html>