<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wextra</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel="stylesheet" href="post.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="margin-left: 5%; margin-right: 5%;">

  <?php
  $url = $_SERVER['REQUEST_URI'];

  // echo $url;

  $partscrap = parse_url($url);

  parse_str($partscrap['query'], $parts);

  $toolid = $parts['toolid'];

  $Aschfilter = $parts['sfi'];

  $Bschinput = $parts['sinput'];

  /* echo "Filter: " . $Aschfilter . " " . gettype($Aschfilter) . "</br>"
      . "Input: " . $Bschinput . " " . gettype($Bschinput);*/

  ?>
  <!-- Index Post -->
  <div class="container max-w-7xl mx-auto mt-8">
    <div class="mb-4">
      <h1 style="margin-left: -2%; margin-top: 10%; font-size: 30px;">
        ประวัติการใช้งาน <?php echo $toolid; ?></h1>
    </div>

  </div>


  <div class="flex justify-start" style="margin-left:5%; margin-top: 5%; width: 100%;">
    <h2 style="margin-right: 0%; margin-top: 1%; font-size:18px; margin-left:-5%; width: 10%;">ค้นหา :</h2>
    <form method="GET" name="searchform" action="ListTools.php" style="width:100%">
      <select style="height: 100%; border-radius:5px; width: 15%; font-size:20px; margin-left: -5%;" name="cateinput" id="cateinput">
        <option <?php if ($Aschfilter == "all") {
                  echo "selected='selected'";
                } ?> value="all">ทั้งหมด</option>
        <option <?php if ($Aschfilter == "tool_spec_ID") {
                  echo "selected='selected'";
                } ?> value="tool_spec_ID">รหัสครุภัณฑ์</option>
        <option <?php if ($Aschfilter == "user_UID") {
                  echo "selected='selected'";
                } ?> value="user_UID">ไอดีผู้ใช้งาน</option>
        <option <?php if ($Aschfilter == "username") {
                  echo "selected='selected'";
                } ?> value="username">ชื่อผู้ใช้งาน</option>
      </select>


      <input style="height: 50px; margin-left: 0%; border-radius:5px; width: 25%;" type="text" class="input" placeholder="ค้นหา ..." name="sinput" id="sinput">
      <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100" style="margin-left: 0.5%;  background-color: #015C92;  color:white;">ค้นหา</button>
    </form>


  </div>

  <?php
  include("../connectdb.php");

  if ($Aschfilter != "all") {
    // A con have input
    if (($Bschinput !== "") && ($Bschinput !== " ") && (!empty($Bschinput))) {
      // B con have input

      $tablequery = "SELECT * FROM ledger_table
        INNER JOIN user ON user.UID = ledger_table.user_UID
        INNER JOIN queue_status_table ON queue_status_table.queue_status = ledger_table.queue_status
        WHERE (tool_all_ID = '$toolid')
        AND ($Aschfilter LIKE '%$Bschinput%')";
    } else {
      // B con no input

      $tablequery = "SELECT * FROM ledger_table
        INNER JOIN user ON user.UID = ledger_table.user_UID
        INNER JOIN queue_status_table ON queue_status_table.queue_status = ledger_table.queue_status
        WHERE tool_all_ID = '$toolid'";
    }
  } else {
    // A con no input
    if (($Bschinput !== "") && ($Bschinput !== " ") && (!empty($Bschinput))) {
      // B con have input

      $tablequery = "SELECT * FROM ledger_table
        INNER JOIN user ON user.UID = ledger_table.user_UID
        INNER JOIN queue_status_table ON queue_status_table.queue_status = ledger_table.queue_status
        WHERE (tool_all_ID = '$toolid')
        AND (
          (tool_spec_ID LIKE '%$Bschinput%')
          OR (user_UID LIKE '%$Bschinput%')
          OR (username LIKE '%$Bschinput%')
        )";
    } else {
      // B con no input

      $tablequery = "SELECT * FROM ledger_table
        INNER JOIN user ON user.UID = ledger_table.user_UID
        INNER JOIN queue_status_table ON queue_status_table.queue_status = ledger_table.queue_status
        WHERE tool_all_ID = '$toolid'";
    }
  }

  $res = $conn->query($tablequery);
  ?>

  <div class="row">
    <div class="col-lg-12">
      <div class="main-box no-header clearfix" style="background-color: #F7F7F7; box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25);">
        <div class="main-box-body clearfix">
          <div class="table-responsive">
            <table class="table user-list" style="margin-bottom:0px; background-color:white;">
              <thead>
                <tr>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>ลำดับ</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>รหัสครุภัณฑ์</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>รหัสนักศึกษา</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>ชื่อ</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>เบอร์โทรศัพท์</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php

                $numrow = 1;

                while ($row = mysqli_fetch_array($res)) {

                ?>
                  <tr>
                    <td width="5%" style="border:2px solid #686868;">
                      <!-- ลำดับ -->
                      <h5 style="text-align: center; color: black; font-size: 18px;"><?php echo $numrow; ?></h5>
                    </td>
                    <td width="15%" style="border:2px solid #686868;">
                      <h5 style="text-align: center; color: black;font-size: 18px;"><?php echo $row["tool_spec_ID"]; ?></h5>
                    </td>
                    <td width="10%" style="border:2px solid #686868;">
                      <h5 style="text-align: center; color: black; font-size: 18px;"><?php echo $row["user_UID"]; ?></h5>
                    </td>
                    <td width="15%" style="border:2px solid #686868;">
                      <h5 style="text-align: center; color: black; font-size: 18px;"><?php echo $row["username"]; ?></h5>
                    </td>
                    <td width="10%" style="border:2px solid #686868; ">
                      <h5 style="text-align: center; color: black; font-size: 18px;"><?php echo $row["phonenum"] ?></h5>
                    </td>
                  </tr>
                <?php

                  $numrow++;
                }

                ?>
              </tbody>
            </table>

          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- <?php

        $rownum = 1;

        while ($row = mysqli_fetch_array($res)) {
          echo "<tr>";
          echo "<td class='px-6 py-4 whitespace-no-wrap border-b border-gray-200'>" . "<div class='content'>" . $rownum . "</div>" . "</td>";
          echo "<td class='px-6 py-4 whitespace-no-wrap border-b border-gray-200'>" . "<div class='content'>" . $row['ID_all'] . "</div>" . "</td>";
          echo "<td class='px-6 py-4 whitespace-no-wrap border-b border-gray-200'>" . "<div class='content'>" . $row['name'] . " " . $row['brand'] . " " . $row['model'] . "</div>" . "</td>";
          echo "<td class='px-6 py-4 whitespace-no-wrap border-b border-gray-200'>" . "<div class='content'>" . $row['type'] . "</div>" . "</td>";
          echo "<td class='px-6 py-4 whitespace-no-wrap border-b border-gray-200'>" . "<div class='content'>" . $row['usable_quantity'] . "</div>" . "</td>";
          echo "<td class='px-6 py-4 whitespace-no-wrap border-b border-gray-200'>" . "<div class='content'>" . $row['defect_quantity'] . "</div>" . "</td>";
          echo "<td class='px-6 py-4 whitespace-no-wrap border-b border-gray-200'>" . "<div class='content'>" . $row['lost_quantity'] . "</div>" . "</td>";
          echo '<td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                  <a href="EditTools.php?toolidall=' . $row['ID_all'] . '" class="text-indigo-600 hover:text-indigo-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" style="margin-left: 30%;" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </a>
                </td>
                <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                  <a href="Toolsdetails.php?toolidall=' . $row['ID_all'] . '" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" style="margin-left: 30%;" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </a>
                </td>
                <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                  <a href="../adminbackend/deltools.php?toolidall=' . $row['ID_all'] . '"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800" fill="none" style="margin-left: 30%;" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </a>
                </td>';
          echo "</tr>";

          $rownum++;
        }

        // while ($row = mysqli_fetch_array($res)) {
        //   echo print_r($row);
        // }
        ?> -->
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
</body>

</html>