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
                    <button id="dateslcbtn">ยืนยัน</button>
                    <label class="credit-card-label" style="margin-left: 8.5%; font-size: 18px; color: #6e6e6e;">ระยะเวลา</label>
                    <input name="e_date" id="e_date" type="number" style="width: 4%;" min="1" max="3" value="1" />
                    <label class="credit-card-label" style="font-size: 18px; color: #6e6e6e;">วัน</label>
                    <!-- <input name="e_date" id="e_date" min="<?php echo $nxtformat; ?>" style=" color: #6e6e6e;  border-radius:5px; background:#D9D9D9; border:none; width: 15%;" placeholder="เลือกวันที่คืน" required /> -->
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
    <!-- Date data fetch -->
    <?php

    $curuscart = "SELECT tool_all_ID, quantity FROM tool_cart 
        WHERE UID = '$uid' 
        AND cart_status_ID = 2";
    $rescuct = $conn->query($curuscart);

    $cuctarr = array();

    $sdldgs = array();
    $edldge = array();

    $rstrcdate = array();

    while ($cuctr = mysqli_fetch_array($rescuct)) {

        $cuctoolid = $cuctr["tool_all_ID"];
        $cuctquant = $cuctr["quantity"];

        $cuctarr[] = [$cuctoolid, $cuctquant];

        // queue status : 1 2 6
        $inledgerc = "SELECT ledger_s_date, ledger_e_date FROM ledger_table
            WHERE tool_all_ID = '$cuctoolid' 
            AND (queue_status = 1 
                OR queue_status = 2 
                OR queue_status = 6)
            ORDER BY ledger_s_date ASC";
        $resinldg = $conn->query($inledgerc);
        $countinldg = mysqli_num_rows($resinldg);

        if ($countinldg >= 1) {

            while ($inldgr = mysqli_fetch_array($resinldg)) {

                $alphaldgrdate = date_create($inldgr["ledger_s_date"]);
                $betaldgrdate = date_create($inldgr["ledger_e_date"]);

                // $ledgerdata[] = [$cuctoolid, $alphaldgrdate, $betaldgrdate];

                // alpha date
                if (isset($apldate)) {

                    if ($alphaldgrdate < $apldate) {

                        $apldate = $alphaldgrdate;
                    }
                } else {

                    $today = date_create("tomorrow");

                    if ($today < $alphaldgrdate) {

                        $apldate = date_create("tomorrow");
                    } else {

                        $apldate = $alphaldgrdate;
                    }
                }

                // beta date
                if (isset($btldate)) {

                    if ($betaldgrdate > $btldate) {

                        $btldate = $betaldgrdate;
                    }
                } else {

                    $btldate = $betaldgrdate;
                }
            }

            if ((isset($apldate)) && (isset($btldate))) {

                // tool stock quantity
                $tospeci = "SELECT * FROM tool_specific_table
                    WHERE tool_all_ID = '$cuctoolid'
                    AND (tool_status = 1
                        OR tool_status = 2)";
                $restspc = $conn->query($tospeci);
                $tspcount = mysqli_num_rows($restspc);

                // first day to final day
                $finaldate = $btldate->modify("+1 day");

                $intervD = new DateInterval("P1D");
                $period = new DatePeriod($apldate, $intervD, $finaldate);

                foreach ($period as $dateval) {

                    // manipulation date format
                    $xdate = date_format($dateval, "Y-m-d");

                    // select from ledger table that xdate within range between ledger .start and .end date
                    $ledgerxbsed = "SELECT * FROM ledger_table
                        WHERE tool_all_ID = '$cuctoolid'
                        AND ledger_s_date <= '$xdate'
                        AND ledger_e_date >= '$xdate'
                        AND (queue_status = 1 
                            OR queue_status = 2
                            OR queue_status = 6)";
                    $resldgxbsed = $conn->query($ledgerxbsed);
                    $xbsedcount = mysqli_num_rows($resldgxbsed);

                    if (($xbsedcount == $cuctquant) || (($tspcount - $xbsedcount) < $cuctquant)) {

                        if (!in_array($xdate, $rstrcdate)) {

                            $rstrcdate[] = $xdate;
                            // echo "<script>console.log('Date: ', ".date_format($dateval, "Y-m-d").", ' added.')</script>";
                        }
                    }
                }
            } else {

                echo "<script>console.log('alpha date or beta date has been disappeared');</script>";
            }
        }
    }
    // print_r($cuctarr);
    // print_r($rstrcdate);

    if (isset($rstrcdate)) {

        $jsonrstrcdate = json_encode($rstrcdate);

        echo "<script>var rstrcarr = " . $jsonrstrcdate . ";</script>";
    }

    ?>

    <!-- Date restriction -->
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script>
        for (var i = 0; i < rstrcarr.length; i++) {
            console.log(rstrcarr[i]);
        }
        // console.log(rstrcarr[0]);
        // // Array of restricted dates
        // var restrictedDates = ["2022-12-25", "2022-12-26", "2022-12-27"];

        // // Add an event listener for the date input field
        // document.getElementById("dateInput").addEventListener("input", function() {
        //     // Get the selected date
        //     var selectedDate = new Date(this.value);

        //     // Check if the selected date is in the array of restricted dates
        //     if (restrictedDates.indexOf(selectedDate.toISOString().substring(0, 10)) !== -1) {
        //         // If the selected date is restricted, show an error message
        //         document.getElementById("errorMessage").innerHTML = "Sorry, that date is not available.";
        //     } else {
        //         // If the selected date is not restricted, clear the error message
        //         document.getElementById("errorMessage").innerHTML = "";
        //     }
        // });

        // var datepicked = function() {
        //     var from = $('#s_date');
        //     var to = $('#e_date');
        //     var fromDate = from.datepicker('getDate');
        //     var toDate = to.datepicker('getDate');

        //     if (toDate && fromDate) {
        //         if (toDate.getTime() < fromDate.getTime()) {
        //             alert('ไม่สามารถคืนในวันนีได้');
        //             $('#e_date').val('');
        //         }
        //     }
        // }

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

        function disableDate(date) {
            var stringd = jQuery.datepicker.formatDate("yy-mm-dd", date);

            return [rstrcarr.indexOf(stringd) == -1];
        }

        $("#s_date").datepicker({
            // onSelect: datepicked,
            // onselect: function(slc) {
            //     console.log(slc);
            // },
            // onChangeMonthYear: function(year, month, inst) {
            //     var slc = $(this).datepicker("getDate");
            //     console.log(slc);
            // },
            dateFormat: 'yy-mm-dd',
            minDate: "+1D", //ไม่สามารถจองวันที่ย้อนหลังได้ 
            // maxDate: "+4D", //จองล่วงหน้าได้ไม่เกิน 2 วัน 
            // beforeShowDay: noWeekends
            beforeShowDay: function(date) {

                if (noWeekends(date)[0]) {
                    return disableDate(date);
                } else {
                    return false;
                }
            }
        });

        // $("#e_date").datepicker({
        //     onSelect: datepicked,
        //     dateFormat: 'yy-mm-dd',
        //     minDate: "+2D", //ไม่สามารถจองวันที่ย้อนหลังได้ 
        //     // maxDate: "+4D", //จองล่วงหน้าได้ไม่เกิน 2 วัน 
        //     beforeShowDay: noWeekends
        // });

        const btnslc = document.getElementById('dateslcbtn');
        const slcdate = document.getElementById('s_date');
        const numinp = document.getElementById('e_date');

        // Dynamic e_date input
        function updateslc() {
            const date = slcdate.value;
            console.log(date);

            numinp.value = 1;

            let ftdate = new Date(date);

            // day 1 + 1 day = day 2
            ftdate.setDate(ftdate.getDate() + 1);
            let unft1 = ftdate.toISOString().split('T')[0];
            var date1 = new Date(unft1);
            var day1 = date1.getDay();
            console.log("ftdate: ", unft1);

            ftdate.setDate(ftdate.getDate() + 1);
            let unft2 = ftdate.toISOString().split('T')[0];
            var date2 = new Date(unft2);
            var day2 = date2.getDay();
            console.log("ftdate: ", unft2);

            if ((rstrcarr.includes(unft1)) || (day1 === 0 || day1 === 6)) {
                console.log("Day 2 exist.");
                numinp.setAttribute("max", 1);
            } else if ((rstrcarr.includes(unft2)) || (day2 === 0 || day2 === 6)) {
                console.log("Day 3 exist.");
                numinp.setAttribute("max", 2);
            } else {
                console.log("Pass");
                numinp.setAttribute("max", 3)
            }
        }

        btnslc.addEventListener('click', updateslc);
    </script>
</body>

</html>