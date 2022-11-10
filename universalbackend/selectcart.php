<?php

include("../connectdb.php");

if (isset($_POST["carter"])) {

    $fromcart = $_POST["carter"];
    $quantinum = $_POST["quantis"];

    $uid = $_COOKIE["userck"];

    $resetsql = "UPDATE tool_cart SET
        cart_status_ID = 1
        WHERE UID = '$uid'";

    $res = $conn->query($resetsql);

    if ($res) {

        $allcartsql = "SELECT * FROM tool_cart
        WHERE UID = '$uid'";

        $resallcart = $conn->query($allcartsql);

        $x = 0;

        while ($rowall = mysqli_fetch_array($resallcart)) {
            $cartID = $rowall["cart_ID"];
            $toolID = $rowall["tool_all_ID"];
            $updatequantitysql = "UPDATE tool_cart SET
            quantity = '$quantinum[$x]'
            WHERE cart_ID = '$cartID'";

            $resquantity = $conn->query($updatequantitysql);

            $x++;
        }

        if ($resquantity) {
            for ($i = 0; $i < sizeof($fromcart); $i++) {
                $selectersql = "UPDATE tool_cart SET
                cart_status_ID = 2
                WHERE cart_ID = '$fromcart[$i]'";

                $resselect = $conn->query($selectersql);
            }

            if ($resselect) {

                echo "<script type='text/javascript'>location.href='../user/AllowPage.php';</script>";
            } else {

                echo "Layer 3 : " . mysqli_error($conn);
                // echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
            }
        } else {

            echo "Layer 2 : " . mysqli_error($conn);
            // echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
        }
    } else {

        echo "Layer 1 : " . mysqli_error($conn);
        // echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
    }
} else {

    echo "<script type='text/javascript'> alert('Select item from cart before submit.') </script>";
    echo "<script type='text/javascript'>location.href='../user/Cart.php';</script>";
}
