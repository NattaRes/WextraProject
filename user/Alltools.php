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
	<link rel="stylesheet" href="alltools.css">
</head>

<body>
	<div style="margin-top: 18%;">
		<div>
			<div class="d-flex justify-content-center h-100">
				<div class="search">
					<input class="search_input" type="text" name="" placeholder="ค้นหาเครื่องมือ...">
					<a href="#" class="search_icon"><i class="fa fa-search"></i></a>
				</div>
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

		$typesql = "SELECT * FROM tool_type_table";

		$quetype = $conn->query($typesql);

		?>

		<?php

		while ($typerow = mysqli_fetch_array($quetype)) {

		?>
			<div style="margin-top: -2%;">
			<h2 style="margin-left: 8%;  color: white;"><?php echo $typerow["type_name"]; ?></h2>
			</div>
			<section id="testimonial_area" class="section_padding" style="margin-top: -10%;">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="testmonial_slider_area text-center owl-carousel" >
								<?php

								$typedef = $typerow["tool_type"];

								$toolsql = "SELECT * FROM tool_all_table WHERE tool_type = '$typedef'";

								$quetool = $conn->query($toolsql);

								while ($toolrow = mysqli_fetch_array($quetool)) {

								?>
								
								
									<div class="box-area">
										<div class="img-area">
											<img src="<?php echo $toolrow["tool_pic_path"]; ?>" alt="" style="width: 280px;height: 160px;
											border-radius: 22px;">
										</div>
									
										<div style="margin-top: 160px;">
											<div>
												<h5 style="float: left;">ชื่อ :</h5>
												<h5 style="float: left; margin-left: 5%;"><?php echo $toolrow["tool_name"]; ?></h5>
											</div>
											<div style="clear: left;  margin-bottom: 10%;">
												<h5 style="float: left;">จำนวน :</h5>
												<h5 style="float: left; margin-left: 2%;">NONE</h5>
												<h5 style="float: left; margin-left: 2%;">ตัว</h5>
												</div>
												<div style="clear: left;  margin-bottom: 10%;">
												<h5 style="float: left;">เหลือ :</h5>
												<h5 style="float: left; margin-left: 2%;">NONE</h5>
												<h5 style="float: left;">ตัว</h5>
											</div>
											<div style="clear: left; margin-bottom: 10%; margin-top: -2%;">

												<h5 style="color: green; margin-right: 70%; margin-bottom: -60%; margin-top: 20%; border:3px black">
													ว่าง</h5>
												<span style="float: left;  margin-top: 6%;" class="dot"></span>


												<input type="number" min="1" max="999" style="width:35%; margin-left:15%;  margin-top:4%;"/>
												
												<a href="../universalbackend/addtocart.php?toolidall=<?php echo $toolrow["tool_all_ID"]; ?>">
													<img src="../image/icon/shopping-cart (2).png" alt="" style=" height: 13%; width: 12%; float: right; margin-top: 3%;">
												</a>
											</div>
											<a href="Detailstools.php?toolidall=<?php echo $toolrow["tool_all_ID"]; ?>">
												<button class="onbutton" type="button">ดูเพิ่มเติม</button>
											</a>
										</div>
				
										</div>
								<?php

								}

								?>
									
							</div>
						</div>
					</div>
				</div>
           
			</section>

		<?php

		}

		?>
	</div>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
	<script>
		$(".testmonial_slider_area").owlCarousel({
			autoplay: true,
			slideSpeed: 1000,
			items: 3,
			loop: true,
			nav: true,
			navText: ['<i class="fa fa-arrow-left" style="font-size:30px; margin-top:15px;  margin-right:5px;"></i>', '<i class="fa fa-arrow-right" style="font-size:30px; margin-top:15px;  margin-left:5px;"></i>'],
			margin: 30,
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