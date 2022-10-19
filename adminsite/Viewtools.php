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
        }

        // while ($row = mysqli_fetch_array($res)) {
        //     echo print_r($row);
        // }
        ?>

        <div class="payment-info">
            <div style="float: left;">
                <img style="border-radius: 20px; background:black; margin-left:10%;" width="300px" src="">

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
            <div><label class="credit-card-label" style="margin-left: 10%; font-size: 20px; color: black; ">สถานะ :</label>
                <label class="credit-card-label" style="font-size: 20px; color: black;">ว่าง</label>
                <label class="credit-card-label" style="margin-left: 14.5%; font-size: 20px; color: black;">สภาพ :</label>
                <label class="credit-card-label" style="font-size: 20px; color: black;">ใช้งานได้</label>
            </div>

            <div style="width: 100%;">
                <label class="credit-card-label" style="margin-left: 10%; font-size: 20px; color: black;">รายละเอียด :</label>
                <label class="credit-card-label" style="font-size: 20px; color: black; "><?php echo $desc; ?></lebel>
            </div>

            <div>
                <a herf="Historytools.html">
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
                                                    <th style="text-align: center; color: #908F8F; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194); "><span>ลำดับ</span></th>
                                                    <th style="text-align: center; color: #908F8F; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>ID</span></th>
                                                    <th style="text-align: center; color: #908F8F; font-weight: bold; font-size: 18px; border: 2px solid rgb(194, 194, 194);"><span>สภาพของครุภัณฑ์</span></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $counter = 1;

                                                while ($specrow = mysqli_fetch_array($specifictable)) {

                                                    echo '<tr>';

                                                    echo '<td style="border: 2px solid rgb(194, 194, 194); ">';
                                                    echo '<h5 style="text-align: center; color: #908F8F; ">' . $counter . '</h5>';
                                                    echo '</td>';

                                                    echo '<td width="40%" style="border: 2px solid rgb(194, 194, 194); ">';
                                                    echo '<span class="user-link1">' . $specrow["tool_spec_ID"] . '</span>';
                                                    echo '</td>';

                                                    echo '<td style="border: 2px solid rgb(194, 194, 194); ">';
                                                    echo '<span class="user-link1">' . $specrow["status"] . '</span>';
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
     
     <!-- Modal content -->
     <div class="modal-content" style=" margin-top: 20%; width: 40%; margin-left:30%; 
     border-radius: 33px; box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.25);">
       <div>
         <h2 style="text-align: center; margin-top: 5%; margin-left: 4%; font-size: 30px; color:black; ">เพิ่มครุภัณฑ์</h2> 
       </div>
       <div style="float: left ; width:50%; margin-bottom: 2%; margin-top: 5%; margin-left: 20%;">
         <label  style="font-size: 20px; color:black; float: left ; margin-top:1%;">
           ID : 
         </label>
         <div style="float: left ; width:50%; margin-bottom: 2%;  margin-left: 5%; ">
             <input 
             style="border-radius: 10px; width:200%; height:40px;" type="text" name="defmodel" id="defmodel"  placeholder="เพิ่ม ID"/>
         </div>
        
         </div>
         <div style="float: left ; width:50%; margin-bottom: 2%; margin-top: 0%; margin-left: 20%;">
         <label  style="font-size: 20px; color:black; float: left ; margin-top:1%;">
           สภาพ : 
         </label>
         <div style="float: left ; width:50%; margin-bottom: 2%;  margin-left: 5%;  ">
         <select id="mySelect" style="margin-left:0%; height:100%; width: 175%; font-size:20px; border-radius:5px;">
            <option value="ann">Ann Frank</option>
            <option value="paul" selected>Paul Allen</option>
            <option value="steve">Steve Jobs</option>
         </select>
         </div>
         </div>
     
           <div class="flex items-center justify-start mt-4 gap-x-2 ">
             <button type="submit" style="width:100px;
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
             <button type="reset" class="close1" style="width:100px;
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
   </div>
   </div>
   
     <!-- Popup -->
  <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close1")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function () {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>

</html>