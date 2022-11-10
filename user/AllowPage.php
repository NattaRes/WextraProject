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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

</head>

<body>

    <?php

    date_default_timezone_set("Asia/Bangkok");

    include("../connectdb.php");

    $uid = $_COOKIE["userck"];

    $usersql = "SELECT * FROM user
        INNER JOIN role_table ON user.role = role_table.role
        WHERE UID = '$uid'";

    $resuser = $conn->query($usersql);

    while ($row = mysqli_fetch_array($resuser)) {
        $name = $row["username"];
        $email = $row["email"];
        $phone = $row["phonenum"];
    }

    ?>

    <div style="margin-top: 8%;">
        <lebel style="font-size: 30px; margin-left: 14.5%; color: white; margin-top: 20%;"> ทำการส่งอนุมัติ </lebel>
    </div>
    <form action="../universalbackend/ledgerquer.php" method="POST">
        <div class="container mt-10 p-3 cart" style="margin-top: 1%; background-color: #F6F6F6; border-radius: 30px; margin-bottom: 4%; margin-left: 13.5%;">
            <div class="payment-info">
                <div style="float:right; margin-right:5%; margin-top:0.5%;">

                    <table class="table user-list" style="margin-bottom:0px; background-color:white; width: 100%; ">
                        <thead>
                            <tr>
                                <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px; border:0.5px solid #6e6e6e; ">
                                    <span>วันที่สามารถขอยืมได้</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td> -->
                                    <?php

                                    // date restricter
                                    $cartrange = "SELECT * FROM tool_cart
                                        WHERE UID = '$uid'
                                        AND cart_status_ID = 2";
                                    $resctrg = $conn->query($cartrange);
                                    $countctrg = mysqli_num_rows($resctrg);

                                    $ydate = array();
                                    $zdate = array();

                                    $endate = array();

                                    for ($gc = 0; $gc < $countctrg; $gc++) {

                                        while ($cartrange = mysqli_fetch_array($resctrg)) {
                                            $cartoolidall = $cartrange["tool_all_ID"];

                                            $carteachID = "SELECT * FROM tool_cart
                                                WHERE tool_all_ID = '$cartoolidall'
                                                AND UID = '$uid'
                                                AND cart_status_ID = 2";
                                            $resctea = $conn->query($carteachID);
                                            $countea = mysqli_num_rows($resctea);

                                            $ledgereachID = "SELECT * FROM ledger_table
                                                WHERE tool_all_ID = '$cartoolidall'
                                                AND (queue_status = 1 OR queue_status = 2 OR queue_status = 6)
                                                ORDER BY ledger_s_date ASC";
                                            $resledea = $conn->query($ledgereachID);

                                            while ($ledea = mysqli_fetch_array($resledea)) {
                                                if (isset($xsdate)) {

                                                    $nexsdate = date_create($ledea["ledger_s_date"]);

                                                    if ($nexsdate < $xsdate) {

                                                        $xsdate = $nexsdate;
                                                    } else {
                                                    }
                                                } else {

                                                    $todaydate = date_create("tomorrow");
                                                    $theledone = date_create($ledea["ledger_s_date"]);

                                                    if ($todaydate < $theledone) {

                                                        $xsdate = date_create("tomorrow");
                                                    } else {
                                                        $xsdate = date_create($ledea["ledger_s_date"]);
                                                    }
                                                }
                                                if (isset($xedate)) {

                                                    $nexedate = date_create($ledea["ledger_e_date"]);

                                                    if ($nexedate > $xedate) {

                                                        $xedate = $nexedate;
                                                    } else {
                                                    }
                                                } else {

                                                    $xedate = date_create($ledea["ledger_e_date"]);
                                                }
                                            }

                                            if ((isset($xedate)) && (isset($xsdate))) {
                                                $modxedate = $xedate->modify("+1 day");

                                                $toolspeceach = "SELECT * FROM tool_specific_table
                                                WHERE tool_all_ID = '$cartoolidall'
                                                AND (tool_status = 1 OR tool_status = 2)";
                                                $restlspea = $conn->query($toolspeceach);
                                                $tlspcount = mysqli_num_rows($restlspea);

                                                $interv = new DateInterval("P1D");
                                                $period = new DatePeriod($xsdate, $interv, $modxedate);

                                                $ledgersted = array();

                                                foreach ($period as $dati) {

                                                    //echo date_format($dati, "d/m/Y");

                                                    $date = date_format($dati, "Y-m-d");

                                                    // date_format($dati, "Y-m-d");

                                                    $ledgerdate = "SELECT * FROM ledger_table
                                                        WHERE tool_all_ID = '$cartoolidall'
                                                        AND ((ledger_s_date < '$date') OR (ledger_s_date = '$date'))
                                                        AND ((ledger_e_date > '$date') OR (ledger_e_date = '$date'))
                                                        AND (queue_status = 1 OR queue_status = 2 OR queue_status = 6)";
                                                    $resledate = $conn->query($ledgerdate);
                                                    $countledate = mysqli_num_rows($resledate);

                                                    // echo "countledate : " . $countledate . "</br>";
                                                    // echo "tlspcount : " . $tlspcount . "</br>";
                                                    // echo "countea : " . $countea . "</br>";

                                                    if (($countledate = $tlspcount) && (($tlspcount - $countledate) < $countea)) {
                                                        // ถ้า จำนวนเครื่องมือ i จาก ledger table ในวันที่ x เท่ากับ จำนวนเครื่องมือ i ที่ใช้ได้
                                                        // และ
                                                        // ถ้า จำนวนเครื่องมือ i ที่ใช้ได้ - จำนวนเครื่องมือ i จาก ledger table ในวันที่ x น้อยกว่า จำนวนเครื่องมือ i จาก cart
                                                        $ledgersted[] = $date;
                                                    } else {
                                                    }
                                                }

                                                //print_r($ledgersted);

                                                for ($xi = 0; $xi < sizeof($ledgersted); $xi++) {

                                                    $datex1 = date_create($ledgersted[$xi]);

                                                    if (isset($ledgersted[$xi + 1])) {

                                                        $datex2 = date_create($ledgersted[$xi + 1]);

                                                        // echo "</br>" . date_format($datex1, "d/m/Y") . " TO " . date_format($datex2, "d/m/Y");

                                                        $datein = date_diff($datex1, $datex2);

                                                        // print_r($datein);

                                                        $dtinint = $datein->format("%d");

                                                        if ($dtinint >= 3) {

                                                            $datex1->modify("+1 day");
                                                            $datex2->modify("-1 day");

                                                            $ydate[$gc][] = $datex1;
                                                            $zdate[$gc][] = $datex2;
                                                            // echo "hello";
                                                        } else {

                                                            // echo "hi";
                                                        }
                                                        // print_r($ydate);
                                                        // print_r($zdate);
                                                    } else {

                                                        $endate[] = $datex1;
                                                        // echo "</br>" . "End at : " . date_format($datex1, "d/m/Y");
                                                    }
                                                }
                                            } else {
                                    ?>
                            <tr>
                                <td style="border:0.5px solid #6e6e6e;">
                                    <h5 style="text-align: center; color: #6e6e6e;">
                                        สามารถจองได้ตั้งแต่วันพรุ่งนี้
                                    </h5>
                                </td>
                            </tr>
                <?php
                                            }
                                        }
                                    }

                ?>
                <!-- </td>
                </tr> -->
                <!-- <tr>
                    <td style="border:0.5px solid #6e6e6e;">
                        <h5 style="text-align: center; color: #6e6e6e;">

                        </h5>
                    </td>
                </tr> -->
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center" style="color: #6e6e6e; font-size: 20px;">
                    <span style="margin-left: 5%;">รายละเอียดผู้ขอยืม</span>
                </div><span class="type d-block mt-3 mb-1"></span>

                <div>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #6e6e6e;">ชื่อ :</label>
                    <label class="credit-card-label" style="margin-right:26%; font-size: 18px; color: #6e6e6e;"><?php echo $name; ?></label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;">รหัสนักศึกษา:</label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e; "><?php echo $uid; ?></label>
                </div>
                <div>
                    <label class="credit-card-label" style="margin-left: 5%; margin-right: 14%; font-size: 18px; color: #6e6e6e;">คณะ : สำนักวิชาศาสตร์และศิลป์ดิจิทัล</label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;">สาขา : เทคโนโลยีดิจิทัล</label>
                </div>
                <div>
                    <label class="credit-card-label" style="margin-left: 5%; margin-right: 11%;font-size: 18px; color: #6e6e6e;">Email : <?php echo $email; ?></label>
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;">เบอร์ติดต่อ : <?php echo $phone; ?></label>
                </div>

                <div>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #6e6e6e;">วันที่ยืม :</label>
                    <input name="s_date" id="s_date" min="<?php echo $stformat; ?>" style=" color: #6e6e6e; margin-right: 10%;  border-radius:5px; background:#D9D9D9; border:none; width: 15%;" placeholder="เลือกวันที่ยืม" value="" required />
                    <label class="credit-card-label" style="margin-left: 8.5%; font-size: 18px; color: #6e6e6e;">วันที่คืน : </label>
                    <input name="e_date" id="e_date" min="<?php echo $nxtformat; ?>" style=" color: #6e6e6e;  border-radius:5px; background:#D9D9D9; border:none; width: 15%;" placeholder="เลือกวันที่คืน" required />
                </div>

                <div>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #6e6e6e;">ผู้อนุมัติ :</label>
                    <?php

                    $aprfetch = "SELECT * FROM user
                        WHERE role = 3";

                    $resapr = $conn->query($aprfetch);

                    ?>
                    <select name="approver_UID" id="approver_UID" style=" color: #6e6e6e;  border-radius:5px; background:#D9D9D9; border:none; width: 15%;" required>เลือก
                        <?php

                        while ($aprow = mysqli_fetch_array($resapr)) {

                        ?>
                            <option value="<?php echo $aprow["UID"]; ?>"><?php echo $aprow["username"]; ?></option>
                        <?php

                        }

                        ?>
                    </select>
                </div>


                <div><label class="credit-card-label" style="margin-left: 5%; font-size: 18px; color: #6e6e6e;">หมายเหตุ :</label>
                    <input name="que_desc" id="que_desc" type="text" style=" color: #6e6e6e;  border-radius:10px; background:#D9D9D9; border:none; width: 25%; height: 5%;" placeholder="ใช้ทำในงานอะไร" required />
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
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                $selectedsql = "SELECT * FROM tool_cart 
                                                    INNER JOIN tool_all_table ON tool_cart.tool_all_ID = tool_all_table.tool_all_ID
                                                    INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type
                                                    INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
                                                    WHERE UID = '$uid'
                                                    AND cart_status_ID = 2";

                                                $reseltool = $conn->query($selectedsql);

                                                $rownum = 1;

                                                $rowcount = mysqli_num_rows($reseltool);

                                                $itemcount = 0;

                                                while ($row = mysqli_fetch_array($reseltool)) {

                                                ?>

                                                    <tr>
                                                        <td width="20%">

                                                            <h5 style="text-align: center; color: #6e6e6e;"><?php echo $rownum; ?></h5>
                                                        </td>
                                                        <td width="60%">
                                                            <img src="<?php echo $row["tool_pic_path"]; ?>" alt="" style="max-width: 20%; border-radius: 22px;">
                                                            <span class="user-link"><?php echo $row["brand_name"] . " " . $row["tool_name"]; ?></span>
                                                            <span class="user-subhead">รุ่น <?php echo $row["tool_model"]; ?></span>
                                                        </td>
                                                        <td>
                                                            <h5 class="user-link1"><?php echo $row["quantity"]; ?></h5>
                                                        </td>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>

                                                    </tr>

                                                <?php

                                                    $itemcount += $row["quantity"];

                                                    $rownum++;
                                                }

                                                ?>

                                                <tr>
                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span>รวมทั้งหมด</span></th>
                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span><?php echo $rowcount; ?> รายการ</span><span> </span></th>
                                                    <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span><?php echo $itemcount; ?> ชิ้น</span></th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>

                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                            <div>
                                <button class="onbutton" type="submit">ส่งคำอนุมัติ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        <?php
        ?>
        var datepicked = function() {
            var from = $('#s_date');
            var to = $('#e_date');
            var fromDate = from.datepicker('getDate');
            var toDate = to.datepicker('getDate');

            if (toDate && fromDate) {
                if (toDate.getTime() < fromDate.getTime()) {
                    alert('ไม่สามารถคืนในวันนีได้');
                    $('#e_date').val('');
                }
            }
        }

        // ฟังก์ชั่นที่จะกำหนดให้เลือกวันหยุดไม่ได้
        function noWeekends(date) {
            var day = date.getDay();
            // ถ้าวันเป็นวันอาทิตย์ (0) หรือวันเสาร์ (6)
            if (day === 0 || day === 6) {
                // เลือกไม่ได้
                return [false, "", "วันนี้เป็นวันหยุด"];
            }
            // เลือกได้ตามปกติ
            return [true, "", ""];
        }

        $("#s_date").datepicker({
            onSelect: datepicked,
            dateFormat: 'yy-mm-dd',
            minDate: "+1D", //ไม่สามารถจองวันที่ย้อนหลังได้ 
            // maxDate: "+4D", //จองล่วงหน้าได้ไม่เกิน 2 วัน 
            beforeShowDay: noWeekends
        });
        $("#e_date").datepicker({
            onSelect: datepicked,
            dateFormat: 'yy-mm-dd',
            minDate: "+2D", //ไม่สามารถจองวันที่ย้อนหลังได้ 
            // maxDate: "+4D", //จองล่วงหน้าได้ไม่เกิน 2 วัน 
            beforeShowDay: noWeekends
        });
    </script>
</body>

</html>