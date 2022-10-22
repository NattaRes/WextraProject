<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wextra</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel="stylesheet" href="cat.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="margin-left: 5%; margin-right: 5%;">
  <!-- Index Cat -->
  <div class="container max-w-7xl mx-auto mt-8">
    <div class="mb-4">
      <h1 style="margin-left: 8%; margin-top: 10%; font-size: 30px;">
        รายการจำแนก</h1>
    </div>

  </div>
  <!-- Button -->
  <div style="align-self: flex-end;   ">
    <a href="addBrand.html">
      <button class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100 " style="background-color: #015C92; color:white; margin-top: 2%; margin-right:auto; margin-left:39%; ">เพิ่มยี่ห้อ</button>
    </a>
    <a href="addCat.html">
      <button class="px-4 py-2 rounded-lg bg-sky-500 text-sky-100 " style="background-color: #015C92; color:white;  margin-top: 2%; margin-right:auto; margin-left:37%; ">เพิ่มหมวดหมู่</button>
    </a>
  </div>

  <?php

  include("../connectdb.php");

  $catetablesql = "SELECT * FROM tool_type_table";
  $cateres = $conn->query($catetablesql);

  $brandtablesql = "SELECT * FROM tool_brand_table";
  $brandres = $conn->query($brandtablesql);

  ?>

  <!-- Table -->
  <div class="row" style="width: 100%; margin: 0%; margin-top: 1%;">
    <div class="col-lg-5">
      <div class="main-box no-header clearfix" style="margin-left:20%; width: 100%; background-color: #F7F7F7; box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25);">
        <div class="main-box-body clearfix">
          <div class="table-responsive">
            <table class="table user-list" style="margin-bottom:0px; background-color:white; width: 100%;">
              <thead>
                <tr>
                  <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>ลำดับ</span>
                  </th>
                  <th width="10%" style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                    <span>ยี่ห้อ</span>
                  </th>

                </tr>
              </thead>
              <tbody>
                <?php

                $rownum_b = 1;

                while ($row = mysqli_fetch_array($brandres)) {
                  echo '<tr>';
                  echo '<td width="10%" style="border:2px solid #686868;">';
                  echo '<h5 style="text-align: center; color: black;">' . $rownum_b . '</h5>';
                  echo '</td>';
                  echo '<td width="10%" style="border:2px solid #686868;">';
                  echo '<h5 style="text-align: center; color: black;">' . $row["brand_name"] . '</h5>';
                  echo '</td>';
                  echo '</tr>';

                  $rownum_b++;
                }

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="column" style="width: 40%; margin-left: 15%; ">
      <div class="row-lg-5">
        <div class="main-box no-header clearfix" style="width: 100%; background-color: #F7F7F7; box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25);">
          <div class="main-box-body clearfix">
            <div class="table-responsive">
              <table class="table user-list" style="margin-bottom:0px; background-color:white; width: 100%;">
                <thead>
                  <tr>
                    <th style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                      <span>ลำดับ</span>
                    </th>
                    <th width="10%" style="text-align: center; color: black; font-weight: bold; font-size: 18px; border:2px solid #686868;">
                      <span>หมวดหมู่</span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                  $rownum_t = 1;

                  while ($row = mysqli_fetch_array($cateres)) {
                    echo '<tr>';
                    echo '<td width="10%" style="border:2px solid #686868;">';
                    echo '<h5 style="text-align: center; color: black;">' . $rownum_t . '</h5>';
                    echo '</td>';
                    echo '<td width="10%" style="border:2px solid #686868;">';
                    echo '<h5 style="text-align: center; color: black;">' . $row["type_name"] . '</h5>';
                    echo '</td>';
                    echo '</tr>';
  
                    $rownum_t++;
                  }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
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