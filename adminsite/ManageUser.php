<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tailwind CSS Create Post UI with form plugins</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel="stylesheet" href="ManageUser.css">
</head>

<body style="margin-left: 5%; margin-right: 5%;">
  <!-- Index Post -->
  <div class="container max-w-7xl mx-auto mt-8">
    <div class="mb-4">
      <h1 class="font-serif text-3xl font-bold underline decoration-gray-400" style="margin-left: 5%; margin-top: 6%;">
        การจัดการผู้ใช้</h1>

    </div>

  </div>


  <div class="flex justify-start" style="margin-left:5%; margin-top: 5%;">

    <?php
    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $Aschfilter = $parts['sfi'];

    $Bschinput = $parts['sinput'];
    ?>

    <h2 style="margin-right: 1%; margin-top: 1%;">ค้นหาผู้ใช้ :</h2>
    <form method="GET" name="searchform" action="ManageUser.php" style="width:50%">
      <select style="height: 40px;" name="sfi" id="sfi">
        <option <?php if ($Aschfilter == "All") {
                  echo "selected='selected'";
                } ?>>All</option>
        <option <?php if ($Aschfilter == "ID") {
                  echo "selected='selected'";
                } ?>>ID</option>
        <option <?php if ($Aschfilter == "Name") {
                  echo "selected='selected'";
                } ?>>Name</option>
        <option <?php if ($Aschfilter == "Email") {
                  echo "selected='selected'";
                } ?>>Email</option>
        <option <?php if ($Aschfilter == "Phone") {
                  echo "selected='selected'";
                } ?>>Phone</option>
      </select>

      <input style="height: 40px; margin-left: 0.5%;" type="text" class="input" placeholder="Search" name="sinput" id="sinput">
      <button class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100 " style="margin-left: 0.5%;">Search</button>
    </form>
    <div style="align-self: flex-end; margin-left: auto; margin-right: 5.5%;">
      <a href="CreatePost.html">
        <button class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100 ">เพิ่มผู้ใช้</button>
      </a>
    </div>

  </div>

  <?php
  include("../connectdb.php");

  // ID username email telnum

  if ($Aschfilter == "ID") {
    // echo "A : ID";
    $Aschfilter = "ID";
  } elseif ($Aschfilter == "Name") {
    // echo "A : username";
    $Aschfilter = "username";
  } elseif ($Aschfilter == "Email") {
    // echo "A : email";
    $Aschfilter = "email";
  } elseif ($Aschfilter == "Phone") {
    // echo "A : telnum";
    $Aschfilter = "telnum";
  } else {
    // echo "Filter : All";
  }

  if ($Aschfilter !== "All") {
    // A con have input
    if (($Bschinput !== "") && ($Bschinput !== " ") && (!empty($Bschinput))) {
      // B con have input
      // echo "A1B1";

      // A : specific , B : empty
      $tablequery = "SELECT * FROM user WHERE $Aschfilter LIKE '%$Bschinput%'";
    } else {
      // B con no input
      // echo "A1B2";

      // A : specific , B : empty
      $tablequery = "SELECT * FROM user";
    }
  } else {
    // A con no input
    if (($Bschinput !== "") && ($Bschinput !== " ") && (!empty($Bschinput))) {
      // B con have input
      // echo "A2B1";

      $tablequery = "SELECT * FROM user WHERE (ID LIKE '%$Bschinput%') OR (username LIKE '%$Bschinput%') OR (email LIKE '%$Bschinput%') OR (telnum LIKE '%$Bschinput%')";
    } else {
      // B con no input
      // echo "A2B2";

      // A : All , B : empty
      $tablequery = "SELECT * FROM user";
    }
  }

  $res = $conn->query($tablequery);
  ?>

  <div class="test" style=" margin-left: 5%; margin-right: 5%; margin-top: 1%;">
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
          <table class="min-w-full" style="width: 50%;">
            <thead>
              <tr>
                <th style="width: 0.001%;">
                  #</th>
                <th class="IDtable">
                  ID</th>
                <th class="Nametable">
                  ชื่อ-นามสกุล</th>
                <th class="catetable">
                  อีเมลล์</th>
                <th class="numtable">
                  เบอร์โทรศัพท์</th>
                <th class="IDtable">
                  Role</th>
                <th class="actable" colspan="4">
                  Action</th>

              </tr>
            </thead>
            <tbody class="bg-white">
              <?php

              $rownum = 1;

              while ($row = mysqli_fetch_array($res)) {

                if ($row['role'] == "admin") {
                  $roleprint = "Admin";
                } elseif ($row['role'] == "stuser") {
                  $roleprint = "User";
                } else {
                  $roleprint = "Unidentify";
                }

                echo "<tr>";
                echo '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">' . '<div class="content">' . $rownum . '</div>' . '</td>';
                echo '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">' . '<div class="content">' . $row['ID'] . '</div>' . '</td>';
                echo '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">' . '<div class="content">' . $row['username'] . '</div>' . '</td>';
                echo '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">' . '<div class="content">' . $row['email'] . '</div>' . '</td>';
                echo '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">' . '<div class="content">' . $row['telnum'] . '</div>' . '</td>';
                echo '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">' . '<div class="content">' . $roleprint . '</div>' . '</td>';
                echo '<td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                  <a href="EditPost.html" class="text-indigo-600 hover:text-indigo-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" style="margin-left: 30%;" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </a>
                </td>
                <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                  <a href="#" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" style="margin-left: 30%;" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </a>
                </td>
                <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800" fill="none" style="margin-left: 30%;" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </a>
                </td>';
                echo '</tr>';

                $rownum++;
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