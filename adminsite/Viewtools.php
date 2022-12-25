<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="vtools.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

</head>

<body>
    <div style="margin-top: 6%; margin-left: 11%;">
    </div>
    <div class="container   mt-10 p-3 cart " style="margin-top: 1%; background-color: #F6F6F6; border-radius: 30px; margin-bottom: 4%; ">

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

        // while ($row = mysqli_fetch_array($res)) {
        //     echo print_r($row);
        // }
        ?>

        <div class="payment-info">
            <div style="float: left;">
                <img src="<?php echo $pic_path; ?>" style="
                height: 30%;
                max-width: 80%;
	            margin: 0 auto;
	            z-index: 1;
                margin-left:45px;
                margin-top:22px;
	            border-radius: 22px; " width="300px" src="">

            </div>
            <div style="color: black;  font-size: 25px;">
                <span style="margin-left: 10%;">รายละเอียด</span>
            </div><span class="type d-block mt-3 mb-1"></span>

            <div>
                <label class="credit-card-label" style="margin-left: 10%; font-size: 20px; color: black; ">ชื่อ :</label>
                <label class="credit-card-label" style="font-size: 20px; margin-left: 1%; color: black; "><?php echo $tname; ?></label>

            </div>
            <div>
                <label class="credit-card-label" style="margin-left: 10%; font-size: 20px; color: black; ">ID :</label>
                <label class="credit-card-label" style="margin-left: 1%; font-size: 20px; color: black; "><?php echo $toolid; ?></label>

            </div>
            <div><label class="credit-card-label" style="margin-left: 10%; font-size: 20px;color: black; ">หมวดหมู่ :</label>
                <label class="credit-card-label" style="font-size: 20px; margin-left: 1%; color: black; "><?php echo $typename; ?></label>

            </div>

            <div>
                <label class="credit-card-label" style="margin-left: 10%; font-size: 20px; color: black; ">ยี่ห้อ : <?php echo $brandname; ?></label>
                <label class="credit-card-label" style="margin-left: 13%; font-size: 20px; color: black; ">รุ่น : <?php echo $tmodel; ?></label>
            </div>

            <div style="width: 100%;">
                <label class="credit-card-label" style="margin-left: 10%; font-size: 20px; color: black;">รายละเอียด :</label>
                <label class="credit-card-label" style="font-size: 20px; color: black; "><?php echo $desc; ?></lebel>
            </div>

            <div>
                <a href="Historytools.php?toolid=<?php echo $toolid; ?>&sfi=all&sinput=">
                    <button class="onbutton" type="button" style="margin-left:10%; margin-top:2%;">ประวัติการใช้งาน</button>
                </a>
            </div>
            <hr noshade="noshade" style="color: black; margin-top: 2%;">

            <div>
                <div style="margin-top: 0%; float:left; margin-left: 2%;">
                    <lebel style="font-size: 25px;  color: black;"> ครุภัณฑ์</lebel>
                </div>
                <div style="margin-right:auto; width: 20%; margin-left:86%;">
                    <a href="#" id="myBtn">
                        <button class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100 " style="background-color: #015C92; color:white; border:none;">เพิ่มครุภัณฑ์</button>
                    </a>
                </div>

                <div class="container bootstrap snippets bootdey">
                    <?php

                    $toolspectable = "SELECT * FROM tool_specific_table 
                        INNER JOIN tool_status_table ON tool_specific_table.tool_status = tool_status_table.tool_status
                        WHERE tool_all_ID = '$toolidall'";

                    $specifictable = $conn->query($toolspectable);

                    ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box no-header clearfix" style="box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25); margin-top: 2%;">
                                <div class="main-box-body clearfix">
                                    <div class="table-responsive">
                                        <table class="table user-list" style="margin-bottom: 0%;">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194); "><span>ลำดับ</span></th>
                                                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>ID</span></th>
                                                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>สภาพของครุภัณฑ์</span></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $counter = 1;

                                                while ($specrow = mysqli_fetch_array($specifictable)) {

                                                    echo '<tr>';

                                                    echo '<td style="border: 2px solid rgb(194, 194, 194); ">';
                                                    echo '<h5 style="text-align: center; color: black; ">' . $counter . '</h5>';
                                                    echo '</td>';

                                                    echo '<td width="40%" style="border: 2px solid rgb(194, 194, 194); ">';
                                                    echo '<span class="user-link1" style="color: black;">' . $specrow["tool_spec_ID"] . '</span>';
                                                    echo '</td>';

                                                    echo '<td style="border: 2px solid rgb(194, 194, 194); ">';
                                                    echo '<span class="user-link1" style="color: black;">' . $specrow["t_status"] . '</span>';
                                                    echo '</td>';

                                                    echo '</tr>';

                                                    $counter++;
                                                }

                                                ?>
                                            </tbody>
                                            <thead>
                                            </thead>
                                        </table>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div id="myModal" class="modal">

                <form action="../adminbackend/addspectools.php" method="POST">

                    <!-- Modal content -->
                    <div class="modal-content" style=" width: 40%; margin-left:30%; border-radius: 33px; box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.25);">
                        <div>
                            <h2 style="text-align: center; margin-top: 5%; margin-left: 4%; font-size: 30px; color:black; ">เพิ่มครุภัณฑ์</h2>
                        </div>
                        <video id="vidbox" style="align-self: center;" width="80%" height="80%" autoplay></video>

                        <div style="float: left ; width:50%; margin-bottom: 2%; margin-top: 5%; margin-left: 20%;">
                            <label style="font-size: 20px; color:black; float: left ; margin-top:1%;">
                                ID :
                            </label>
                            <div style="float: left ; width:50%; margin-bottom: 2%;  margin-left: 5%; ">
                                <input style="border-radius: 10px; width:200%; height:40px;" type="text" name="specificID" id="specificID" placeholder="เพิ่ม ID" />
                                <input name="toolidall" type="hidden" value="<?php echo $toolidall; ?>" />
                            </div>

                        </div>
                        <div style="float: left ; width:50%; margin-bottom: 2%; margin-top: 0%; margin-left: 20%;">
                            <label style="font-size: 20px; color:black; float: left ; margin-top:1%;">
                                สภาพ :
                            </label>
                            <div style="float: left ; width:50%; margin-bottom: 2%;  margin-left: 5%;  ">
                                <?php

                                $tstatsql = "SELECT * FROM tool_status_table ORDER BY tool_status";
                                $reststa = $conn->query($tstatsql);

                                ?>
                                <select name="statusct" id="mySelect" style="margin-left:0%; height:100%; width: 175%; font-size:20px; border-radius:5px;">
                                    <?php

                                    while ($tstarow = mysqli_fetch_array($reststa)) {

                                    ?>

                                        <option value="<?php echo $tstarow["tool_status"]; ?>"><?php echo $tstarow["t_status"]; ?></option>

                                    <?php

                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-start mt-4 gap-x-2 ">
                            <button id="suborcan" type="submit" style="width:100px;
                                    height:40px;
                                    border:none;
                                    font-size: 20px;
                                    border-radius:5px;
                                    margin-left:55%;
                                    background: #015C92;              
                                    color:#fff;
                                    cursor:pointer;
                                    margin-bottom:5%;">
                                ยืนยัน
                            </button>
                            <button id="suborcan" type="reset" class="close1" style="width:100px;
                                    height:40px;
                                    border:none;
                                    font-size: 20px;
                                    border-radius:5px;
                                    background:rgba(192, 0, 0, 0.777);	
                                    color:#fff;
                                    cursor:pointer;
                                    margin-bottom:5%;">
                                ยกเลิก
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

        <!-- Popup -->
        <script type="text/javascript">
            var videoElement = document.getElementById("vidbox");
            var constraints = {
                video: true
            };

            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close1")[0];

            var scnr = new Instascan.Scanner({
                video: document.getElementById("vidbox"),
                scanPeriod: 5,
                mirror: false
            });

            // When the user clicks on the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
                videoElement.style.display = 'block';
                // if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                //     // Call the getUserMedia method with the constraints
                //     navigator.mediaDevices.getUserMedia(constraints)
                //         .then(function(stream) {
                //             // Set the srcObject property of the video element to the MediaStream object
                //             videoElement.srcObject = stream;
                //         })
                //         .catch(function(error) {
                //             // Log the error to the console
                //             console.error('Error opening camera:', error);
                //         });
                // }
                scnr.addListener('scan', function(content) {
                    //alert(content);
                    document.getElementById("specificID").setAttribute("value", content);
                    scnr.stop();
                    videoElement.style.display = 'none';
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
                modal.style.display = "none";
                scnr.stop();
                // if (videoElement.srcObject) {
                //     videoElement.srcObject.getTracks().forEach(track => track.stop());
                // }
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    scnr.stop();
                }
            }
        </script>
</body>

</html>