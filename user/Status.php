<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="status.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <?php

    include("../connectdb.php");

    $uid = $_COOKIE["userck"];

    $statussql = "SELECT * FROM queue_table WHERE que_owner_UID = '$uid' ORDER BY s_date ASC";

    $restatus = $conn->query($statussql);

    ?>

    <div style="margin-top: 8%;">
        <lebel style="font-size: 30px; margin-left: 15%; color: white; margin-top: 20%;"> สถานะการยืม </lebel>
    </div>
    <div class="container mt-10 p-3 cart" style="margin-top: 1%; background-color: #F6F6F6; border-radius: 30px; ">
        <div class="container bootstrap snippets bootdey" style="margin-top: 1%;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box no-header clearfix" style="border-radius: 22px; background-color: #F7F7F7; box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25);">
                        <div class="main-box-body clearfix">
                            <div class="table-responsive">
                                <table class="table user-list">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;">
                                                <span>ลำดับ</span>
                                            </th>
                                            <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;">
                                                <span>วันที่ยืม</span>
                                            </th>
                                            <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;">
                                                <span>วันที่คืน</span>
                                            </th>
                                            <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;">
                                                <span>จำนวน</span>
                                            </th>
                                            <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;" width="15%">
                                                <span>สถานะ</span>
                                            </th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $counter = 1;

                                        while ($row = mysqli_fetch_array($restatus)) {

                                            $qid = $row["que_ID"];

                                            $ledgerlist = "SELECT * FROM ledger_table WHERE que_ID = '$qid'";

                                            $resled = $conn->query($ledgerlist);

                                            $ledgercounter = mysqli_num_rows($resled);

                                            $s_date = date_create($row["s_date"]);

                                            $e_date = date_create($row["e_date"]);

                                        ?>

                                            <tr>
                                                <td width="10%">
                                                    <!-- ลำดับ -->
                                                    <h5 style="text-align: center; color: #6e6e6e;"><?php echo $counter; ?></h5>
                                                </td>
                                                <td width="10%">
                                                    <h5 style="text-align: center; color: #6e6e6e;"><?php echo date_format($s_date, "d/m/Y"); ?></h5>
                                                </td>
                                                <td width="10%">
                                                    <h5 style="text-align: center; color: #6e6e6e;"><?php echo date_format($e_date, "d/m/Y"); ?></h5>
                                                </td>
                                                <td width="10%">
                                                    <h5 style="text-align: center; color: #6e6e6e;"><?php echo $ledgercounter; ?> รายการ </h5>
                                                </td>
                                                <td width="10%" align="center">
                                                    <div>
                                                        <?php

                                                        $questat = $row["queue_status"];

                                                        if ($questat == 1) {
                                                            // Pending

                                                            echo '<span style="float: left; margin-left: 15%; margin-top: 4%; background-color: #D7BA00;" class="dot"></span>
                                                            <h5 style="text-align: center; color:#D7BA00; font-size: 20px;  margin-right: 15%;">รอการอนุมัติ</h5>';
                                                        } elseif ($questat == 2) {
                                                            // Approved

                                                            echo '<span style="float: left; margin-left: 15%; margin-top: 4%;" class="dot"></span>
                                                            <h5 style="text-align: center; color:green; font-size: 20px; margin-right: 15%;">อนุมัติ</h5>';
                                                        } elseif ($questat == 3) {
                                                            // Disapproved

                                                            echo '<span style="float: left; margin-left: 15%; margin-top: 4%; background-color: red" class="dot"></span>
                                                            <h5 style="text-align: center; color:red; font-size: 20px;  margin-right: 15%;">ไม่อนุมัติ</h5>';
                                                        } elseif ($questat == 4) {
                                                            // Timeout

                                                            echo '<span style="float: left; margin-left: 15%; margin-top: 4%; background-color: red" class="dot"></span>
                                                            <h5 style="text-align: center; color:red; font-size: 20px;  margin-right: 15%;">หมดเวลาอนุมัติ</h5>';
                                                        } elseif ($questat == 5) {
                                                            // Cancel

                                                            echo '<span style="float: left; margin-left: 15%; margin-top: 4%; background-color: red" class="dot"></span>
                                                            <h5 style="text-align: center; color:red; font-size: 20px;  margin-right: 15%;">ถูกยกเลิก</h5>';
                                                        } else {
                                                        }

                                                        ?>
                                                    </div>
                                                </td>
                                                <td width="15%" align="center" colspan="3">

                                                    <a href="Detailstatus.php?queid=<?php echo $row["que_ID"]; ?>">
                                                        <button style="background-color:rgba(1, 93, 146, 0.777); 
                                                            border-radius: 22px; width: 40%; margin-right: 4%;
                                                            color: #ffffff; font-size: 18px;
                                                            border: none;">
                                                            เรียกดู
                                                        </button>
                                                    </a>
                                                    <a href="../universalbackend/deluserque.php?queid=<?php echo $row["que_ID"]; ?>">
                                                    <button style="background-color:rgba(192, 0, 0, 0.777); 
                                                        border-radius: 22px; width: 40%; 
                                                        color: #ffffff; font-size: 18px;
                                                        border: none;">
                                                        ยกเลิก
                                                    </button>
                                                    </a>
                                                            
                                                </td>
                                                
                                            </tr>

                                        <?php

                                            $counter++;
                                        }

                                        ?>

                                        <tr>
                                            <!-- เส้น -->
                                            <th>&nbsp;</th>
                                            <th><span></span></th>
                                            <th><span></span></th>
                                            <th><span></span></th>
                                            <th><span></span></th>
                                            <th><span></span></th>
                                            <th><span></span></th>
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