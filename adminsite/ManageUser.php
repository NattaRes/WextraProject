<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wextra</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel="stylesheet" href="ManageUser.css">
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
        จัดการผู้ใช้งาน</h1>
    </div>

  </div>


  <div class="flex justify-start" style="margin-left:5%; margin-top: 5%; width: 100%;">

    <?php
    include("../connectdb.php");

    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $Aschfilter = $parts['sfi'];

    $Bschinput = $parts['sinput'];

    ?>
    <h2 style="margin-right: 0%; margin-top: 1%; font-size:18px; margin-left:-5%; width: 10%;">ค้นหาผู้ใช้ :</h2>
    <form method="GET" name="searchform" action="ManageUser.php" style="width:100%">
      <select style="height: 45px; border-radius:5px; width: 15%; font-size:20px; margin-left: -2%;" name="sfi" id="sfi">
        <option <?php if ($Aschfilter == "all") {
                  echo "selected='selected'";
                } ?>>All</option>
        <option <?php if ($Aschfilter == "Unspecified") {
                  echo "selected='selected'";
                } ?> value="UID">User ID</option>
        <option <?php if ($Aschfilter == "Camera") {
                  echo "selected='selected'";
                } ?> value="username">ชื่อผู้ใช้งาน</option>
        <option <?php if ($Aschfilter == "Lighting") {
                  echo "selected='selected'";
                } ?> value="email">อีเมลล์</option>
        <option <?php if ($Aschfilter == "Microphone") {
                  echo "selected='selected'";
                } ?> value="phonenum">หมายเลขโทรศัพท์</option>
      </select>


      <input style="height: 45px; margin-left: 0%; border-radius:5px; width: 25%;" type="text" class="input" placeholder="ค้นหา ..." name="sinput" id="sinput">
      <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100" style="margin-left: 0.5%;  background-color: #015C92;  color:white;">ค้นหา</button>
    </form>
    <!-- <div style="align-self: flex-end;  margin-right:auto; width: 20%; margin-left:15%; margin-bottom:1%;">
      <a href="Adduser.html">
        <button class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100 " style="background-color: #015C92;  color:white;">เพิ่มผู้ใช้</button>
      </a>
    </div>-->

  </div>

  <?php

  if ($Aschfilter !== "all") {
    // A con have input
    if (($Bschinput !== "") && ($Bschinput !== " ") && (!empty($Bschinput))) {
      // B con have input

      $tablequery = "SELECT * FROM user
        INNER JOIN role_table ON user.role = role_table.role
        WHERE $Aschfilter LIKE '%$Bschinput%'";
    } else {
      // B con no input

      $tablequery = "SELECT * FROM user
        INNER JOIN role_table ON user.role = role_table.role";
    }
  } else {
    // A con no input
    if (($Bschinput !== "") && ($Bschinput !== " ") && (!empty($Bschinput))) {
      // B con have input

      $tablequery = "SELECT * FROM user
        INNER JOIN role_table ON user.role = role_table.role
        WHERE (UID LIKE '%$Bschinput%')
        OR (username LIKE '%$Bschinput%')
        OR (email LIKE '%$Bschinput%')
        OR (phonenum LIKE '%$Bschinput%')";
    } else {
      // B con no input

      $tablequery = "SELECT * FROM user
        INNER JOIN role_table ON user.role = role_table.role";
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
                    <span>User ID</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>ชื่อผู้ใช้งาน</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>อีเมลล์</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>เบอร์โทรศัพท์</span>
                  </th>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>Role</span>
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
                  echo '<td width="10%" style="border:2px solid #686868;">';
                  echo '<h5 style="text-align: center; color: black;">' . $rownum . '</h5>';
                  echo '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">';
                  echo '<h5 style="text-align: center; color: black;">' . $row["UID"] . '</h5>';
                  echo '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">';
                  echo '<h5 style="text-align: center; color: black;">' . $row["username"] . '</h5>';
                  echo '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">';
                  echo '<h5 style="text-align: center; color: black;">' . $row["email"] . '</h5>';
                  echo '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">';
                  echo '<h5 style="text-align: center; color: black;">' . $row["phonenum"] . '</h5>';
                  echo '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">';
                  echo '<h5 style="text-align: center; color: black;">' . $row["name_r"] . '</h5>';
                  echo '</td>';
                  echo '<td width="15%" align="center" colspan="3" style="border:2px solid #686868;">
                      <a href="#">
                        <button style="background-color:rgba(255, 122, 0, 0.69);
                                      border-radius: 22px; width: 25%; margin-right: 4%;
                                      color: #ffffff; font-size: 18px;
                                      border: none;">
                          แก้ไข
                        </button>
                      </a>
                      <button style="background-color:rgba(192, 0, 0, 0.777); 
                                      border-radius: 22px; width: 25%; 
                                      color: #ffffff; font-size: 18px;
                                      border: none;">
                        ลบ
                      </button>
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
 
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>

 
</body>

</html>