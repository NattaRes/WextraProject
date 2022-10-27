<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="blog.css">
</head>

<body>
    <div style="margin-top: 10%; margin-left: 50%;">
        <label>ข่าวสาร</label>
    </div>

    <?php

    include("../connectdb.php");

    $postsql = "SELECT * FROM post_table";

    $quepost = $conn->query($postsql);

    $numrow = mysqli_num_rows($quepost);

    ?>

        <!--image slider start-->
        <div class="slider">
            <div class="slides">
                <!--radio buttons start-->
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">
                <!--radio buttons end-->
                <!--slide images start-->
                <div class="slide first">
                    <img src="https://www.learningstudio.info/wp-content/uploads/2013/08/Untitled8.png" alt="">
                </div>
                <div class="slide">
                    <img src="https://www.learningstudio.info/wp-content/uploads/2013/08/Untitled8.png" alt="">
                </div>
                <div class="slide">
                    <img src="https://www.learningstudio.info/wp-content/uploads/2013/08/Untitled8.png" alt="">
                </div>
                <div class="slide">
                    <img src="https://www.learningstudio.info/wp-content/uploads/2013/08/Untitled8.png" alt="">
                </div>
                <!--slide images end-->
                <!--automatic navigation start-->
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
                <!--automatic navigation end-->
            </div>
            <!--manual navigation start-->
            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
            <!--manual navigation end-->
        </div>
        <!--image slider end-->

    <script type="text/javascript">
        var counter = 1;
        setInterval(function() {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 5000);
    </script>

    <div class="container d-flex justify-content-center mt-50 mb-50">

        <div class="row">
            <div class="col-md-12">

                <?php 

                while ($row = mysqli_fetch_array($quepost)) {
                
                ?>

                <div class="card blog-horizontal" style="border-radius: 20px; box-shadow:0px 1px 4px 4px rgba(0, 0, 0, 0.25); width: 90%; margin-left: 6%;">
                    <div class="card-body">
                        <div class="card-img-actions mr-sm-3 mb-3" style="max-width: 100%;">
                            <a href="#course_preview" data-toggle="modal" data-abc="true">
                                <img src="<?php echo $row["post_pic_path"]; ?>" class="img-fluid card-img" alt="">
                            </a>
                        </div>

                        <div class="mb-3">
                            <h4 class="d-flex font-weight-bold flex-nowrap my-1" style="color: #918F8F;"><?php echo $row["post_title"]; ?></h4>
                            <ul class="list-inline list-inline-dotted text-muted mb-0">
                                <li class="list-inline-item" style="font-size: 16px;"><?php echo $row["post_time"]; ?></li>
                            </ul>
                        </div>

                        <div style="width: 80%;">
                            <p style="color: #918F8F; font-size: 16px;"><?php echo $row["post_desc"]; ?></p>
                        </div>
                    </div>
                </div>

                <?php 
                
                }
                
                ?>

            </div>

        </div>
    </div>
    </div>
</body>

</html>