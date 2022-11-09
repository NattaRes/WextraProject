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
    <div style="margin-top: 6%; margin-left: 0%;">
        <h2 style="font-size: 30px; margin-left: 7%;  margin-right: 70%; color: black; "> รายการยืม </h2>
        <div class="container mt-10 p-3 cart" style="margin-top: 1%; background-color: #F6F6F6; border-radius: 30px; margin-bottom: 4%; ">
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
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 20px; color: black; ">หมายเลขคิว :</label>
                    <label class="credit-card-label" style="font-size: 20px; margin-left: 1%; color: black; "><?php echo $queid; ?></label>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 20px; color: black; ">ชื่อ :</label>
                    <label class="credit-card-label" style="font-size: 20px; margin-left: 1%; color: black; "><?php echo $username; ?></label>
                    <label class="credit-card-label" style="margin-left: 8%; font-size: 20px; color: black; ">รหัสนักศึกษา:</label>
                    <label class="credit-card-label" style="margin-left: 1%; font-size: 20px; color: black; "><?php echo $queowner; ?></label>

                </div>
                <div>


                </div>
                <div>
                    <label class="credit-card-label" style="margin-left: 5%; margin-right: 22.4%; font-size: 20px; color: black; ">คณะ : กระทรวงเวทย์มนต์</label>
                    <label class="credit-card-label" style="font-size: 20px; color: black; ">สาขา : เทคโนโลยีดิจิทัล</label>
                </div>
                <div><label class="credit-card-label" style="margin-left: 5%; margin-right: 11%; font-size: 20px;color: black; ">Email : <?php echo $email; ?></label>
                    <label class="credit-card-label" style="font-size: 20px; color: black; ">เบอร์ติดต่อ : <?php echo $phone; ?></label>
                </div>
                <div><label class="credit-card-label" style="margin-left: 5%; margin-right: 20.5%;  font-size: 20px; color: black; ">วันที่ยืม :</label>
                    <label class="credit-card-label" style="font-size: 20px; color: black;"><?php echo date_format($s_date, "d/m/Y"); ?></label>
                    <label class="credit-card-label" style="font-size: 20px; color: black;">หมายเหตุ :</label>
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
                                                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>ครุภัณฑ์</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="border: 2px solid rgb(194, 194, 194); ">

                                                        <h5 style="text-align: center; color: black; ">1</h5>
                                                    </td>
                                                    <td width="40%" style="border: 2px solid rgb(194, 194, 194); ">
                                                        <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" style="max-width: 100%; border-radius: 22px;">
                                                        <span class="user-link" style="color: black;">กล้อง</span>
                                                        <span class="user-subhead" style="color: black;">รุ่น</span>
                                                    </td>
                                                    <td style="border: 2px solid rgb(194, 194, 194); ">
                                                        <select id="mySelect" style="margin-left:25%; height:100%; width: 50%; font-size:20px; border-radius:5px;">
                                                            <option value="ann">Ann Frank</option>
                                                            <option value="paul" selected>Paul Allen</option>
                                                            <option value="steve">Steve Jobs</option>
                                                        </select>
                                                    </td>

                                                </tr>

                                            </tbody>
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; color: black;  font-size: 18px; border-left: 0px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194); border-left: 2px solid rgb(194, 194, 194);"><span></span></th>
                                                    <th style="text-align: right; color: black; font-weight: bold; font-size: 18px; border-bottom: 2px solid rgb(194, 194, 194);"><span>รวมทั้งหมด</span></th>
                                                    <th style="text-align: center; color: black;  font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>3</span></th>

                                                </tr>
                                            </thead>
                                        </table>

                                    </div>

                                </div>
                            </div>
                            <div>
                                <button class="onbutton" type="button">ยืนยันรับอุปกรณ์</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>