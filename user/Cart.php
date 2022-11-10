<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="cartui.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

</head>

<body>

    <?php

    include("../connectdb.php");

    $uid = $_COOKIE["userck"];

    $cartsql = "SELECT * FROM tool_cart 
        INNER JOIN tool_all_table ON tool_cart.tool_all_ID = tool_all_table.tool_all_ID
        INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type
        INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
        WHERE UID = '$uid'";

    $quecart = $conn->query($cartsql);

    ?>

    <div style="margin-top: 8%;">
        <lebel style="font-size: 30px; margin-left: 14.5%; color: white; margin-top: 20%;"> ตะกร้า </lebel>
    </div>
    <div class="container mt-10 p-3 cart" style="margin-top: 1%; background-color: #F6F6F6; border-radius: 30px; margin-bottom: 4%; margin-left: 13.5%;">
        <div>
            <div class="container bootstrap snippets bootdey" style="margin-top: 2%;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box no-header clearfix" style="border-radius: 22px; box-shadow: 0px 0px 4px 4px rgba(109, 109, 109, 0.25);">
                            <div class="main-box-body clearfix">
                                <div class="table-responsive">
                                    <table class="table user-list">
                                        <thead>
                                            <tr>
                                                <th><span></span></th>
                                                <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span>ลำดับ</span></th>
                                                <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span>ชื่ออุปกรณ์</span></th>
                                                <th style="text-align: center; color: #6e6e6e; font-weight: bold; font-size: 18px;"><span>จำนวน</span></th>

                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <form action="../universalbackend/selectcart.php" method="POST">
                                            <tbody>

                                                <?php

                                                $rownum = 1;

                                                while ($row = mysqli_fetch_array($quecart)) {

                                                    $toolid = $row["tool_all_ID"];

                                                    $toolspecsql = "SELECT * FROM tool_specific_table
                                                        WHERE tool_all_ID = '$toolid'
                                                        AND (tool_status = 1 OR tool_status = 2)";
                                                    $resta = $conn->query($toolspecsql);
                                                    $countresta = mysqli_num_rows($resta);

                                                ?>

                                                    <tr>
                                                        <td width="10%">
                                                            <label class="container">
                                                                <input class="input1" type="checkbox" name="carter[]" value="<?php echo $row["cart_ID"]; ?>">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>

                                                            <h5 style="text-align: center; color: #6e6e6e;"><?php echo $rownum; ?></h5>
                                                        </td>
                                                        <td width="40%">
                                                            <img src="<?php echo $row["tool_pic_path"]; ?>" alt="" style="max-width: 40%; border-radius: 22px;">
                                                            <span class="user-link"><?php echo $row["brand_name"] . " " . $row["tool_name"]; ?></span>
                                                            <span class="user-subhead">รุ่น <?php echo $row["tool_model"]; ?></span>
                                                        </td>
                                                        <td align="center">
                                                        <input name="quantis[]" type="number" min="1" max="<?php echo $countresta; ?>" style="width:35%; font-size:16px;" value="<?php echo $row["quantity"]; ?>"/>
                                                        </td>

                                                        <td style="width: 10%;">
                                                            <a href="../universalbackend/delfromcart.php?toolidall=<?php echo $row["tool_all_ID"]; ?>" class="table-link danger">
                                                                <span>
                                                                    <img src="../image/icon/trash.png" style="width: 40%; height:40%;" />
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                <?php

                                                    $rownum++;
                                                }

                                                ?>

                                            </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <div>
                            <button class="onbutton" type="submit">ยืนยัน</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
</body>

</html>