<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="vpost.css">
</head>

<body>

    <?php

    include("../connectdb.php");

    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $postID = $parts['postid'];

    $tablequery = "SELECT * FROM post_table 
        INNER JOIN user ON post_table.UID = user.UID
        WHERE post_ID = '$postID'";

    $res = $conn->query($tablequery);

    while ($row = mysqli_fetch_array($res)) {
        $title = $row["post_title"];
        $date = $row["post_time"];
        $desc = $row["post_desc"];
        $pic_path = $row["post_pic_path"];
        $uid = $row["UID"];
        $username = $row["username"];
    }

    ?>

    <div class="container d-flex justify-content-center mt-50 mb-50" style="margin-top:10%;">
        <div class="row">
            <div class="col-md-12">
                <div class="card blog-horizontal mt-5" style="border-radius: 20px; box-shadow:0px 1px 4px 4px rgba(0, 0, 0, 0.25); width: 90%; margin-left: 6%;">
                    <div class="card-body">
                        <div class="card-img-actions mr-sm-3 mb-3" style="max-width: 50%; float: left;">
                            <a href="#course_preview" data-toggle="modal" data-abc="true">
                                <img src="<?php echo $pic_path; ?>" class="img-fluid card-img" alt="">
                            </a>
                        </div>
                        <div class="mb-3">
                            <h4 class="d-flex font-weight-bold flex-nowrap my-1" style="color: black;"><?php echo $title; ?></h4>
                            <ul class="list-inline list-inline-dotted text-muted mb-0">
                                <li class="list-inline-item" style="font-size: 16px;"><?php echo $date; ?></li>
                            </ul>
                        </div>
                        <div style="width: 100%;">
                            <p style="color: black; font-size: 16px;"><?php echo $desc; ?></p>
                        </div>
                    </div>
                    <a href="EditPost.php?postid=<?php echo $postID; ?>">
                        <button style="background-color:rgba(255, 122, 0, 0.69);
                        border-radius: 22px; width: 15%; margin-left: 80%; margin-top:-6%;
                        color: #ffffff; font-size: 18px;
                        border: none;">
                            แก้ไข
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>