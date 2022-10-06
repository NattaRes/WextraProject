<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tailwind CSS Create Post UI with form plugins</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel="stylesheet" href="listTools.css">
</head>

<body style="margin-left: 5%; margin-right: 5%;">
  <!-- Index Post -->
  <div class="container max-w-7xl mx-auto mt-8">
    <div class="mb-4">
      <h1 class="font-serif text-3xl font-bold underline decoration-gray-400" style="margin-left: 5%; margin-top: 6%;">
        รายการเครื่องมือ</h1>

    </div>

  </div>


  <div class="flex justify-start" style="margin-left:5%; margin-top: 5%;">

    <?php
    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $Acatefilter = $parts['cateinput'];

    $Bschfilter = $parts['sfi'];

    $Cschinput = $parts['sinput'];

   /* echo "Category: " . $Acatefilter . " " . gettype($Acatefilter) . "</br>"
      . "Filter: " . $Bschfilter . " " . gettype($Bschfilter) . "</br>"
      . "Input: " . $Cschinput . " " . gettype($Cschinput);*/

    ?>
    <h2 style="margin-right: 1%; margin-top: 1%;">ค้นหาเครื่องมือ :</h2>
    <form method="get" name="searchform" action="ListTools.php" style="width:50%">
      <select style="height: 40px;" name="cateinput" id="cateinput">
        <option <?php if ($Acatefilter == "All") {
                  echo "selected='selected'";
                } ?>>All</option>
        <option <?php if ($Acatefilter == "Unspecified") {
                  echo "selected='selected'";
                } ?>>Unspecified</option>
        <option <?php if ($Acatefilter == "Camera") {
                  echo "selected='selected'";
                } ?>>Camera</option>
        <option <?php if ($Acatefilter == "Lighting") {
                  echo "selected='selected'";
                } ?>>Lighting</option>
        <option <?php if ($Acatefilter == "Microphone") {
                  echo "selected='selected'";
                } ?>>Microphone</option>
      </select>
      <select style="height: 40px;" name="sfi" id="sfi">
        <option <?php if ($Bschfilter == "All") {
                  echo "selected='selected'";
                } ?>>All</option>
        <option <?php if ($Bschfilter == "ID") {
                  echo "selected='selected'";
                } ?>>ID</option>
        <option <?php if ($Bschfilter == "Name") {
                  echo "selected='selected'";
                } ?>>Name</option>
        <option <?php if ($Bschfilter == "Brand") {
                  echo "selected='selected'";
                } ?>>Brand</option>
      </select>


      <input style="height: 40px; margin-left: 0%;" type="text" class="input" placeholder="Search" name="sinput" id="sinput">
      <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100 " style="margin-left: 0.5%;">Search</button>
    </form>
    <div style="align-self: flex-end; margin-left: auto; margin-right: 5.5%;">
      <a href="CreateTools.php">
        <button class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100">เพิ่มเครื่องมือ</button>
      </a>
    </div>

  </div>

  <div class="test" style=" margin-left: 5%; margin-right: 5%; margin-top: 1%;">
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
          <table class='min-w-full' style='width: 50%;'>
            <thead>
              <tr>
                <th class='IDtable'>
                  ลำดับ</th>
                <th class='Nametable'>
                  อุปกรณ์
                </th>
                <th class='catetable'>
                  ประเภทอุปกรณ์</th>
                <th class='numtable'>
                  ใช้งานได้</th>
                <th class='numtable'>
                  ชำรุด</th>
                <th class='numtable'>
                  สูญหาย</th>
                <th class='actable' colspan='4'>
                  Action</th>

              </tr>
            </thead>
            <tbody class='bg-white'>
              <?php
              include("../connectdb.php");

              if ($Bschfilter == "ID") {
                // echo "B : ID_all";
                $Bschfilter = "ID_all";
              } elseif ($Bschfilter == "Name") {
                // echo "B : name";
                $Bschfilter = "name";
              } elseif ($Bschfilter == "Brand") {
                // echo "B : brand";
                $Bschfilter = "brand";
              } else {
                // echo "Filter : All";
              }

              // echo "</br>";
              // echo $Bschfilter;

              if ($Acatefilter !== "All") {
                // A con have input
                if ($Bschfilter !== "All") {
                  // B con have input
                  if (($Cschinput !== "") && ($Cschinput !== " ") && (!empty($Cschinput))) {
                    // C con have input
                    //echo "A1B1C1";

                    // A : specific , B : specific , C : fill
                    $tablequery = "SELECT * FROM tools_all WHERE (type = '$Acatefilter') AND ($Bschfilter LIKE '%$Cschinput%')";
                  } else {
                    // C con no input
                    //echo "A1B1C2";

                    // A : specific , B : specific , C : empty
                    $tablequery = "SELECT * FROM tools_all WHERE type = '$Acatefilter'";
                  }
                } else {
                  // B con no input
                  if (($Cschinput !== "") && ($Cschinput !== " ") && (!empty($Cschinput))) {
                    // C con have input
                    //echo "A1B2C1";

                    // A : specific , B : All , C : fill
                    $tablequery = "SELECT * FROM tools_all WHERE (type = '$Acatefilter') AND ((name LIKE '%$Cschinput%') OR (brand LIKE '%$Cschinput%') OR (model LIKE '%$Cschinput%'))";
                  } else {
                    // C con no input
                   // echo "A1B2C2";

                    // A : specific , B : All , C : empty
                    $tablequery = "SELECT * FROM tools_all WHERE type = '$Acatefilter'";
                  }
                }
              } else {
                // A con no input
                if ($Bschfilter !== "All") {
                  // B con have input
                  if (($Cschinput !== "") && ($Cschinput !== " ") && (!empty($Cschinput))) {
                    // C con have input
                    //echo "A2B1C1";

                    // A : All , B : specific , C : fill
                    $tablequery = "SELECT * FROM tools_all WHERE $Bschfilter LIKE '%$Cschinput%'";
                  } else {
                    // C con no input
                    //echo "A2B1C2";

                    // A : All , B : specific , C : empty
                    $tablequery = "SELECT * FROM tools_all";
                  }
                } else {
                  // B con no input
                  if (($Cschinput !== "") && ($Cschinput !== " ") && (!empty($Cschinput))) {
                    // C con have input
                   // echo "A2B2C1";

                    // A : All , B : All , C : fill
                    $tablequery = "SELECT * FROM tools_all WHERE (name LIKE '%$Cschinput%') OR (brand LIKE '%$Cschinput%') OR (model LIKE '%$Cschinput%')";
                  } else {
                    // C con no input
                   // echo "A2B2C2";

                    // A : All , B : All , C : empty
                    $tablequery = "SELECT * FROM tools_all";
                  }
                }
              }

              $res = $conn->query($tablequery);

              while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
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
              }

              while ($row = mysqli_fetch_array($res)) {
                echo print_r($row);
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>