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
    <script src="https://code.ionicframework.com/nightly/js/ionic.bundle.js"></script>
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
                    <label class="credit-card-label" style="margin-left: 5%; margin-right: 23.8%; font-size: 20px; color: black; ">สำนักวิชา : NONE</label>
                    <label class="credit-card-label" style="font-size: 20px; color: black; ">สาขา : NONE</label>
                </div>
                <div><label class="credit-card-label" style="margin-left: 5%; margin-right: 11.2%; font-size: 20px;color: black; ">Email : <?php echo $email; ?></label>
                    <label class="credit-card-label" style="font-size: 20px; color: black; ">เบอร์ติดต่อ : <?php echo $phone; ?></label>
                </div>
                <div><label class="credit-card-label" style="margin-left: 5%;font-size: 20px; color: black; ">วันที่ยืม :</label>
                    <label class="credit-card-label" style="font-size: 20px;  margin-right: 28%;   color: black;"><?php echo date_format($s_date, "d/m/Y"); ?></label>
                    <label class="credit-card-label" style="font-size: 20px; color: black;">หมายเหตุ :</label>
                    <label class="credit-card-label" style="font-size: 20px; color: black;"><?php echo $qdesc; ?></label>
                </div>
                <!-- <div>
                    <label class="credit-card-label" style="margin-left: 5%; font-size: 20px; color: black;">ใบเสร็จ :</label>
                    <button class="onbuttonprint" type="button">ดาวน์โหลด</button>
                </div> -->
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
                                                </tr>
                                            </thead>
                                            <form id="theForm" action="../adminbackend/recivtool.php" method="POST">
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
                                                                <img src="<?php echo $ledgerlist["tool_pic_path"]; ?>" alt="" style="max-width: 20%; border-radius: 22px;">
                                                                <span class="user-link" style="color: black;"><?php echo $ledgerlist["brand_name"] . " " . $ledgerlist["tool_name"]; ?></span>
                                                                <span class="user-subhead" style="color: black;">รุ่น <?php echo $ledgerlist["tool_model"]; ?></span>
                                                            </td>
                                                            <input type="hidden" name="ledgerID[]" value="<?php echo $ledgerID; ?>" />
                                                            <td style="border: 2px solid rgb(194, 194, 194); ">

                                                                <!-- <select name="toolspec[]" id="slc_<?php echo $ledgerID; ?>" style="margin-left:25%; height:100%; width: 50%; font-size:20px; border-radius:5px; <?php if ($rownum > 1) { ?>display: none;<?php } ?>" onchange="rmvOpt(this.id, this.value)" required> -->
                                                                <select name="toolspec[]" id="slc_<?php echo $toolidall; ?>_<?php echo $rownum; ?>" style="margin-left:25%; height:100%; width: 50%; font-size:20px; border-radius:5px; <?php if ($rownum > 1) { ?>display: none;<?php } ?>" required>
                                                                    <option disabled selected value> -- select an option -- </option>

                                                                    <?php

                                                                    $specificsql = "SELECT * FROM tool_specific_table
                                                                        WHERE tool_all_ID = '$toolidall'
                                                                        AND tool_status = 1
                                                                        ORDER BY tool_spec_ID ASC";
                                                                    $respec = $conn->query($specificsql);

                                                                    $specount = 1;

                                                                    while ($specrow = mysqli_fetch_array($respec)) {

                                                                        $specID = $specrow["tool_spec_ID"];
                                                                    ?>
                                                                        <option value="<?php echo $specID; ?>"><?php echo $specID; ?></option>

                                                                    <?php

                                                                        $specount++;
                                                                    }

                                                                    ?>
                                                                </select>
                                                                <button type="button" class="onbutton" id="istbtn_<?php echo $rownum; ?>" style="margin-top:-7%; <?php if ($rownum > 1) { ?>display: none;<?php } ?>" onclick="modaldis(<?php echo $rownum; ?>, <?php echo $toolidall; ?>)">QR code</button>
                                                                <button type="button" class="onbutton" id="lockbtn_<?php echo $rownum; ?>" style="margin-top: 1%;<?php if ($rownum > 1) { ?>display: none;<?php } ?>" onclick="lockechc(<?php echo $rownum; ?>, <?php echo $toolidall; ?>)">ยืนยัน</button>

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
                                                        <th style="text-align: center; color: black;  font-size: 18px; border-left: 0px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194); border-left: 2px solid rgb(194, 194, 194);"><span></span></th>
                                                        <th style="text-align: right; color: black; font-weight: bold; font-size: 18px; border-bottom: 2px solid rgb(194, 194, 194);"><span>รวมทั้งหมด</span></th>
                                                        <th style="text-align: center; color: black;  font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span><?php echo $itemcount; ?></span></th>

                                                    </tr>
                                                </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div>
                                <button class="onbutton" id="submiter" type="submit" style="display: none;" disabled>ยืนยันรับอุปกรณ์</button>

                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top:30%;">

        </div>
        <!-- The Modal -->
        <div id="insertmodal" class="modal">

            <!-- Modal content -->
            <div class="modal-content" style=" width: 40%; margin-left:30%; border-radius: 33px; box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.25);">
                <span class="close" style="margin-left:95%; font-size: 35px;">&times;</span>
                <div>
                    <p id="ledid"></p>
                </div>
                <video id="vidbox" style="align-self: center;" width="80%" height="80%" autoplay></video>
                <div>
                </div>
            </div>
        </div>

        <div id="authenmodal" class="modal">

            <!-- Modal content -->
            <div class="modal-content" style=" width: 40%; margin-left:30%; border-radius: 33px; box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.25);">
                <span class="close" style="margin-left:95%; font-size: 35px;">&times;</span>
                <div>
                </div>
                <div>
                </div>
            </div>
        </div>

        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

        <!-- Popup -->
        <script>
            var videoElement = document.getElementById("vidbox");
            var constraints = {
                video: true
            };

            // Get the modal
            var istmodal = document.getElementById("insertmodal");

            // Get the button that opens the modal
            // var btn = document.getElementById("istbtn");

            // var lobtn = document.getElementById("lockbtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            // btn.onclick = function() {
            //     istmodal.style.display = "block";
            // }

            const ptest = document.getElementById("ledid");

            var subtn = document.getElementById("submiter");

            var stedlist = [];
            var idenlist = [];

            var hiddeneer = document.createElement("input");
            hiddeneer.setAttribute("type", "hidden");
            hiddeneer.setAttribute("name", "toolspec")

            var scnr = new Instascan.Scanner({
                video: document.getElementById("vidbox"),
                scanPeriod: 5,
                mirror: false
            });

            function modaldis(id, tlidall) {
                istmodal.style.display = "block";
                videoElement.style.display = 'block';
                var slcidscn = "#slc_" + tlidall + "_" + id;
                var slcorscn = document.querySelector(slcidscn);
                scnr.addListener('scan', function(content) {
                    //alert(content);
                    var valcheck = Array.prototype.some.call(slcorscn.options, function(option) {

                        return option.value === content && !stedlist.includes(content);
                    });

                    if (!valcheck) {

                        ptest.innerHTML = "This tool specific ID isn't an option or has been selected.";
                    } else {

                        slcorscn.value = content;
                        scnr.stop();
                        videoElement.style.display = 'none';
                        istmodal.style.display = "none";
                    }
                    // scnr.stop();
                    // videoElement.style.display = 'none';
                    //window.location.href=content;
                });
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scnr.start(cameras[0]);
                        $('[name="options"]').on('change', function() {
                            if ($(this).val() == 1) {
                                if (cameras[0] != "") {
                                    scnr.start(cameras[0]);
                                } else {
                                    alert('No Front camera found!');
                                }
                            } else if ($(this).val() == 2) {
                                if (cameras[1] != "") {
                                    scnr.start(cameras[1]);
                                } else {
                                    alert('No Back camera found!');
                                }
                            }
                        });
                    } else {
                        console.error('No cameras found.');
                        alert('No cameras found.');
                    }
                }).catch(function(e) {
                    console.error(e);
                    // alert(e);
                });
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                istmodal.style.display = "none";
                ptest.innerHTML = "";
                scnr.stop();
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == istmodal) {
                    istmodal.style.display = "none";
                    scnr.stop();
                }
            }

            function lockechc(id, tlidall) {
                var slcid = "slc_" + tlidall + "_" + id;
                var istid = "istbtn_" + id;
                var locid = "lockbtn_" + id;

                var slcor = document.getElementById(slcid);
                var istbtn = document.getElementById(istid);
                var lockbtn = document.getElementById(locid);

                slcor.disabled = true;
                istbtn.style.display = "none";
                lockbtn.style.display = "none";

                stedlist.push(slcor.value);
                idenlist.push(tlidall);

                var slcelmtl = document.querySelectorAll("select[id*='" + tlidall + "']");
                Array.prototype.filter.call(slcelmtl, function(select) {

                    return select.id !== slcor.id;
                });
                for (var i = 0; i < slcelmtl.length; i++) {

                    var slcelmtlindiv = slcelmtl[i];
                    for (var x = 0; x < slcelmtlindiv.options.length; x++) {

                        if (slcelmtlindiv.options[x].value === slcor.value) {

                            // slcelmtlindiv.options[x].remove();
                            slcelmtlindiv.options[x].disabled = true;
                            break;
                        }
                    }
                }

                if (document.querySelector("select[id$='" + (id + 1) + "']")) {

                    var slcnext = document.querySelector("select[id$='" + (id + 1) + "']");
                    var istnxid = "istbtn_" + (id + 1);
                    var locnxid = "lockbtn_" + (id + 1);

                    var istnext = document.getElementById(istnxid);
                    var locnext = document.getElementById(locnxid);

                    slcnext.style.display = "block";
                    istnext.style.display = "block";
                    locnext.style.display = "block";
                } else {

                    hiddeneer.setAttribute("value", JSON.stringify(stedlist));
                    document.getElementById("theForm").appendChild(hiddeneer);

                    subtn.disabled = false;
                    subtn.style.display = "block";
                }

            }



            // var prevslcopt = [];

            // function rmvOpt(id, slcopt) {

            //     var slcelm = document.querySelectorAll("select[name='toolspec[]']");
            //     if (prevslcopt.indexOf(slcopt) > -1) {

            //         for (var i = 0; i < slcelm.length; i++) {

            //             var slc = slcelm[i];
            //             if (slc.id !== id) {

            //                 var opt = document.createElement("option");
            //                 opt.value = slcopt;
            //                 opt.text = slcopt;
            //                 slc.add(opt);
            //             }
            //         }

            //         prevslcopt.splice(prevslcopt.indexOf(slcopt), 1);
            //     } else {

            //         for (var x = 0; x < slcelm.length; x++) {

            //             var slc = slcelm[x];
            //             if (slc.id !== id) {

            //                 var opt = slc.options;
            //                 for (var y = 0; y < opt.length; y++) {

            //                     if (opt[y].value === slcopt) {

            //                         slc.remove(y);
            //                         break;
            //                     }
            //                 }
            //             }
            //         }

            //         prevslcopt.push(slcopt);
            //     }
            // }
        </script>
</body>

</html>