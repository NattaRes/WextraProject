<!DOCTYPE html>
<html lang="en">
<!--divinectorweb.com-->

<head>
	<meta charset="UTF-8">
	<title>Responsive Testimonial Slider</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">

	<!-- Swiper CSS -->
	<link rel="stylesheet" href="sw.css" />

	<link rel="stylesheet" href="alltools.css">

	<script>
		function searcher() {
			document.getElementById("submit").click();
		}
	</script>

</head>

<body>
	<div style="margin-top: 18%;">
		<div>
			<div class="d-flex justify-content-center h-100">
				<form action="Alltools.php" method="GET">
					<div class="search">
						<input class="search_input" type="text" name="sinput" placeholder="ค้นหาเครื่องมือ...">
						<input type="submit" id="submit" hidden />
						<a onclick="searcher()" class="search_icon"><i class="fa fa-search"></i></a>
					</div>
				</form>
			</div>
			<div style="height: 25%; width: 25%; float:right; margin-top:-8.5%; margin-right:2%;">
				<a href="Cart.php">
					<img src="../image/icon/shopping-cart (2).png" alt="" class="carticon">
				</a>
			</div>
		</div>

	</div>

	</div>

	<?php

	include("../connectdb.php");

	$url = $_SERVER['REQUEST_URI'];

	// echo $url;

	$partscrap = parse_url($url);

	parse_str($partscrap['query'], $parts);

	$Ashinput = $parts['sinput'];

	$Btpinput = $parts['tpin'];

	if (($Ashinput !== "") && ($Ashinput !== " ") && (!empty($Ashinput))) {
		$typesql = "SELECT * FROM tool_type_table
			INNER JOIN tool_all_table ON tool_all_table.tool_type = tool_type_table.tool_type
			WHERE (tool_name LIKE '%$Ashinput%')";
	} else {
		if ($Btpinput !== "all") {
			if ($Btpinput == "other") {
				$typesql = "SELECT * FROM tool_type_table
					WHERE (tool_type != 1)
					OR (tool_type != 2)
					OR (tool_type != 4)";
			} else {
				$typesql = "SELECT * FROM tool_type_table
					WHERE tool_type = '$Btpinput'";
			}
		} else {
			$typesql = "SELECT * FROM tool_type_table";
		}
	}

	$typesql = "SELECT * FROM tool_type_table";

	$quetype = $conn->query($typesql);

	while ($typerow = mysqli_fetch_array($quetype)) {


		$typedef = $typerow["tool_type"];

		if (($Ashinput !== "") && ($Ashinput !== " ") && (!empty($Ashinput))) {
			$toolsql = "SELECT * FROM tool_all_table 
				WHERE (tool_type = '$typedef')
				AND (tool_name LIKE '%$Ashinput%')";
		} else {

			$toolsql = "SELECT * FROM tool_all_table WHERE tool_type = '$typedef'";
		}

		$quetool = $conn->query($toolsql);
		$countquetool = mysqli_num_rows($quetool);

		if ($countquetool >= 1) {

	?>
			<div style="margin-top: -2%;">
				<h2 style="margin-left: 8%;  color: white;"><?php echo $typerow["type_name"]; ?></h2>
			</div>
			<section id="testimonial_area" class="section_padding" style="margin-top: -10%;">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="testmonial_slider_area text-center owl-carousel">

								<?php
								while ($toolrow = mysqli_fetch_array($quetool)) {

									$toolAID = $toolrow["tool_all_ID"];

									$toolspecsql = "SELECT * FROM tool_specific_table
										WHERE tool_all_ID = '$toolAID'
										AND (tool_status = 1 OR tool_status = 2)";
									$resta = $conn->query($toolspecsql);
									$countresta = mysqli_num_rows($resta);

									$novacsql = "SELECT * FROM tool_specific_table
										WHERE tool_all_ID = '$toolAID'
										AND tool_status = 1";
									$resconovac = $conn->query($novacsql);
									$countresnovac = mysqli_num_rows($resconovac);

								?>

									<form action="../universalbackend/addtocart.php" method="POST" onsubmit='redirect();return false;'>
										<input type="hidden" name="toolcount" value="<?php echo $countresta; ?>" />
										<div class="box-area">
											<div class="img-area">
												<img src="<?php echo $toolrow["tool_pic_path"]; ?>" alt="" style="width: 160px;height: 160px; margin-left:20%;
											border-radius: 22px;">
											</div>

											<div style="margin-top: 160px;">
												<div>
													<h5 style="float: left;">ชื่อ :</h5>
													<h5 style="float: left; margin-left: 5%;"><?php echo $toolrow["tool_name"]; ?></h5>
												</div>
												<div style="clear: left;  margin-bottom: 10%;">
													<h5 style="float: left;">จำนวน :</h5>
													<h5 style="float: left; margin-left: 2%;"><?php echo $countresta; ?></h5>
													<h5 style="float: left; margin-left: 2%; margin-right: 25%;">ตัว</h5>
													<h5 style="float: left;">เหลือ :</h5>
													<h5 style="float: left; margin-left: 2%;"><?php echo $countresnovac; ?></h5>
													<h5 style="float: left; margin-left: 2%;">ตัว</h5>
												</div>

												<div style="clear: left; margin-bottom: 10%; margin-top: -2%;">

													<h5 style=" margin-right: 85%; margin-bottom: -60%; margin-top: 20%; border:3px black">
														เลือก</h5>
													<!-- <span style="float: left;  margin-top: 6%;" class="dot"></span> -->
													<input name="toolidall" type="hidden" value="<?php echo $toolrow["tool_all_ID"]; ?>" />
													<input name="quantinum" type="number" <?php if ($countresta >= 1) { ?> min="1" max="<?php echo $countresta; ?>" <?php } ?> style="width:35%; margin-left:15%;  margin-top:4%;" value="1" />

													<input name="submit" type="image" src="../image/icon/shopping-cart (2).png" alt="Submit" style=" height: 13%; width: 12%; float: right; margin-top: 3%;" />
													<!-- <a href="../universalbackend/addtocart.php?toolidall=<?php echo $toolrow["tool_all_ID"]; ?>">
													<img src="../image/icon/shopping-cart (2).png" alt="" style=" height: 13%; width: 12%; float: right; margin-top: 3%;">
												</a> -->

												</div>
												<a href="Detailstools.php?toolidall=<?php echo $toolrow["tool_all_ID"]; ?>">
													<button class="onbutton" type="button">ดูเพิ่มเติม</button>
												</a>
											</div>
										</div>
									</form>

								<?php
								}
								?>

								<!-- icon nav next -->
								<i></i>
								<i></i>
							</div>
						</div>
					</div>
				</div>

			</section>

	<?php
		}
	}


	?>
	</div>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
	/*<script>
		$(".testmonial_slider_area").owlCarousel({
			autoplay: true,
			slideSpeed: 1000,
			items: 3,
			nav: true,
			navText: ['<i class="fa fa-arrow-left" style="font-size:30px; margin-top:15px;  margin-right:5px;"></i>', '<i class="fa fa-arrow-right" style="font-size:30px; margin-top:15px;  margin-left:5px;"></i>'],
			margin: 10,
			dots: true,
			responsive: {
				320: {
					items: 1
				},
				767: {
					items: 2
				},
				600: {
					items: 2
				},
				1000: {
					items: 3
				},


			}

		});
	</script>

</body>

</html>