<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wextra</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel="stylesheet" href="listTools.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="margin-left: 5%; margin-right: 5%;">
  <!-- Index Post -->
  <div class="container max-w-7xl mx-auto mt-8">
    <div class="mb-4">
      <h1 style="margin-left: -2%; margin-top: 10%; font-size: 30px;">
        รายการเครื่องมือ</h1>
    </div>

  </div>


  <div class="flex justify-start" style="margin-left:5%; margin-top: 5%; width: 100%;">

    <?php
    include("../connectdb.php");

    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $Acatefilter = $parts['cateinput'];

    $Bschfilter = $parts['sfi'];

    $Cschinput = $parts['sinput'];

    $typetable = "SELECT * FROM tool_type_table";

    $typeres = $conn->query($typetable);

    /* echo "Category: " . $Acatefilter . " " . gettype($Acatefilter) . "</br>"
      . "Filter: " . $Bschfilter . " " . gettype($Bschfilter) . "</br>"
      . "Input: " . $Cschinput . " " . gettype($Cschinput);*/

    ?>
    <h2 style="margin-right: 0%; margin-top: 1%; font-size:18px; margin-left:-5%; width: 13%;">ค้นหาเครื่องมือ :</h2>
    <form method="GET" name="searchform" action="ListTools.php" style="width:100%">
      <select style="height: 40px; border-radius:5px; width: 15%; font-size:20px;" name="cateinput" id="cateinput">
        <option <?php if ($Acatefilter == "all") {
                  echo "selected='selected'";
                } ?> value="all">ทั้งหมด</option>
        <?php
        while ($typerow = mysqli_fetch_array($typeres)) {
          echo '<option value="' . $typerow["tool_type"] . '"';
          if ($Acatefilter == $typerow["tool_type"]) {
            echo 'selected="selected"';
          }
          echo '>' . $typerow["type_name"] . '</option>';
        }
        ?>
      </select>
      <select style="height: 40px;  border-radius:5px; width: 15%; font-size:20px;" name="sfi" id="sfi">
        <option <?php if ($Bschfilter == "all") {
                  echo "selected='selected'";
                } ?> value="all">ทั้งหมด</option>
        <option <?php if ($Bschfilter == "tool_all_ID") {
                  echo "selected='selected'";
                } ?> value="tool_all_ID">ID</option>
        <option <?php if ($Bschfilter == "tool_name") {
                  echo "selected='selected'";
                } ?> value="tool_name">อุปกรณ์</option>
        <option <?php if ($Bschfilter == "tool_brand_table.brand_name") {
                  echo "selected='selected'";
                } ?> value="tool_brand_table.brand_name">ยี่ห้อ</option>
      </select>


      <input style="height: 50px; margin-left: 0%; border-radius:5px; width: 25%;" type="text" class="input" placeholder="ค้นหา ..." name="sinput" id="sinput">
      <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100" style="margin-left: 0.5%;  background-color: #015C92;  color:white;">ค้นหา</button>
    </form>
    <div style="align-self: flex-end;  margin-right:auto; width: 20%; margin-bottom:1%;">
      <a href="CreateTools.php">
        <button class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100 " style="background-color: #015C92; color:white;">เพิ่มเครื่องมือ</button>
      </a>
    </div>

  </div>

  <?php

  if ($Acatefilter !== "all") {
    // A con have input
    if ($Bschfilter !== "all") {
      // B con have input
      if (($Cschinput !== "") && ($Cschinput !== " ") && (!empty($Cschinput))) {
        // C con have input
        // echo "A1B1C1";

        // A : specific , B : specific , C : fill
        $tablequery = "SELECT * FROM tool_all_table 
          INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
          INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type 
          WHERE (tool_type_table.tool_type = '$Acatefilter') 
          AND ($Bschfilter LIKE '%$Cschinput%')";
      } else {
        // C con no input
        // echo "A1B1C2";

        // A : specific , B : specific , C : empty
        $tablequery = "SELECT * FROM tool_all_table 
          INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
          INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type 
          WHERE tool_type_table.tool_type = '$Acatefilter'";
      }
    } else {
      // B con no input
      if (($Cschinput !== "") && ($Cschinput !== " ") && (!empty($Cschinput))) {
        // C con have input
        // echo "A1B2C1";

        // A : specific , B : All , C : fill
        $tablequery = "SELECT * FROM tool_all_table 
          INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
          INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type 
          WHERE (tool_type_table.tool_type = '$Acatefilter') 
          AND ((tool_name LIKE '%$Cschinput%') 
          OR (tool_brand_table.tool_brand LIKE '%$Cschinput%') 
          OR (tool_model LIKE '%$Cschinput%'))";
      } else {
        // C con no input
        // echo "A1B2C2";

        // A : specific , B : All , C : empty
        $tablequery = "SELECT * FROM tool_all_table 
          INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
          INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type 
          WHERE tool_type_table.tool_type = '$Acatefilter'";
      }
    }
  } else {
    // A con no input
    if ($Bschfilter !== "all") {
      // B con have input
      if (($Cschinput !== "") && ($Cschinput !== " ") && (!empty($Cschinput))) {
        // C con have input
        // echo "A2B1C1";

        // A : All , B : specific , C : fill
        $tablequery = "SELECT * FROM tool_all_table 
          INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
          INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type 
          WHERE $Bschfilter LIKE '%$Cschinput%'";
      } else {
        // C con no input
        // echo "A2B1C2";

        // A : All , B : specific , C : empty
        $tablequery = "SELECT * FROM tool_all_table 
          INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
          INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type";
      }
    } else {
      // B con no input
      if (($Cschinput !== "") && ($Cschinput !== " ") && (!empty($Cschinput))) {
        // C con have input
        // echo "A2B2C1";

        // A : All , B : All , C : fill
        $tablequery = "SELECT * FROM tool_all_table 
          INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
          INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type 
          WHERE (tool_all_ID LIKE '%$Cschinput%') 
          OR (tool_name LIKE '%$Cschinput%') 
          OR (tool_brand_table.brand_name LIKE '%$Cschinput%') 
          OR (tool_model LIKE '%$Cschinput%')";
      } else {
        // C con no input
        // echo "A2B2C2";

        // A : All , B : All , C : empty
        $tablequery = "SELECT * FROM tool_all_table 
          INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
          INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type";
      }
    }
  }

  

  $res = $conn->query($tablequery);
  ?>

  <div class="row">
    <div class="col-lg-12">
      <div class="main-box no-header clearfix" style="background-color: #F7F7F7; box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25);">
        <div class="main-box-body clearfix">
          <div class="table-responsive">
            <table class="table user-list" style="margin-bottom:0px; background-color:white; border:2px solid #686868;">
              <thead>
                <tr>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>ลำดับ</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>ID</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>อุปกรณ์</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>ประเภท</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>จำนวน</span>
                  </th>

                  <th style="border-top:2px solid #686868;border-bottom:2px solid #686868;">&nbsp;</th>
                  <th style="border-top:2px solid #686868;border-bottom:2px solid #686868;border-right:2px solid #686868;">&nbsp;</th>

                </tr>
              </thead>
              <tbody>
                <?php

                $rownum = 1;

                while ($row = mysqli_fetch_array($res)) {
                  echo '<tr>';
                  echo '<td width="10%" style="border:2px solid #686868;">' . '<h5 style="text-align: center; color: black;">' . $rownum . '</h5>' . '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">' . '<h5 style="text-align: center; color: black;">' . $row["tool_all_ID"] . '</h5>' . '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">' . '<h5 style="text-align: center; color: black;">' . $row["tool_name"] . ' ' . $row["brand_name"] . ' ' . $row["tool_model"] . '</h5>' . '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">' . '<h5 style="text-align: center; color: black;">' . $row["type_name"] . '</h5>' . '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">' . '<h5 style="text-align: center; color: black;">' . "NUMBER" . '</h5>' . '</td>';
                  echo '<td width="15%" align="center" colspan="3">
                      <a href="Viewtools.php?toolidall=' . $row["tool_all_ID"] . '">
                        <button style="background-color:rgba(1, 93, 146, 0.777); 
                        border-radius: 22px; width: 25%; margin-right: 4%;
                        color: #ffffff; font-size: 18px;
                        border: none;">
                        เรียกดู
                        </button>
                      </a>
                      <a href="EditTools.php?toolidall=' . $row["tool_all_ID"] . '">
                        <button style="background-color:rgba(255, 122, 0, 0.69);
                        border-radius: 22px; width: 25%; margin-right: 4%;
                        color: #ffffff; font-size: 18px;
                        border: none;">
                        แก้ไข
                        </button>
                      </a>
                      <a href="#' . $row["tool_all_ID"] . ' " id="myBtn">
                        <button style="background-color:rgba(192, 0, 0, 0.777); 
                        border-radius: 22px; width: 25%; 
                        color: #ffffff; font-size: 18px;
                        border: none;">
                        ลบ
                        </button>
                      </a>
                    </td>';
                  echo '</tr>';

                  $rownum++;
                }

                // while ($row = mysqli_fetch_array($res)) {
                //   echo print_r($row);
                // }
                //deltools.php?toolidall=
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="myModal" class="modal">
     
		<!-- Modal content -->
		<div class="modal-content" style="margin-top: 15%; width: 40%;   border-radius: 25px;">
		  <div>
			<h2 style="text-align: center; margin-top: 2%; margin-left: 2%; font-size: 30px;">ยืนยันการลบข้อมูล</h2> 
		  </div>
		  <div style="float: left ; width:50%; margin-bottom: 2%; margin-top: 5%; margin-left: 26%;">
			<label  style="font-size: 20px; width: 150%;">
			 ต้องการดำเนินการต่อหรือไ่ม่?
			</label>
       </div>
			  <div class="flex items-center justify-start mt-4 gap-x-2">
				<button type="submit" style="width:150px;
				height:40px;
				border:none;
				font-size: 20px;
				border-radius:5px;
				margin-left:70%;
				background: #015C92;              
				color:#fff;
				cursor:pointer;">
				  ยืนยัน
				</button>
				<button type="reset" class="close1" style="background-color:rgba(192, 0, 0, 0.777);">
				  ยกเลิก
				</button>
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