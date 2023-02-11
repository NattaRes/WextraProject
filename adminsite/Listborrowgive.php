<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
	<link rel="stylesheet" href="Listborrgive.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <script src="https://code.ionicframework.com/nightly/js/ionic.bundle.js"></script>
</head>

<body>
	<div style="margin-top:8%;">

	</div>

	<div class="mytabs">
		<input type="radio" id="tabborrow" name="mytabs" checked="checked">

		<label for="tabborrow" style="font-size: 18px;">รายการยืมเครื่องมือ</label>
		<div class="tab">
			<div class="test" style=" margin-left: 5%; margin-right: 5%;">
				<div class="flex flex-col">
					<div>
						<div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
							<table class="min-w-full" style="min-width: 100%;  border: 2px solid rgb(194, 194, 194); ">
								<thead>
									<tr>
										<th style="font-weight: medium;
										text-align: center;
										text-transform: uppercase;
										border-right: 2px solid rgb(194, 194, 194);
										width: 10%; font-size: 18px; background-color: white; ">
											คิว
										</th>
										<th style="font-weight: medium;
										text-align: center;
										text-transform: uppercase;
										border-right: 2px solid rgb(194, 194, 194);
										width: 40%; font-size: 18px; background-color: white;">
											รายการรับ
										</th>
										<th style="font-weight: medium;
										text-align: center;
										text-transform: uppercase;
										border-right: 2px solid rgb(194, 194, 194);
										width: 35%; font-size: 18px; background-color:white; ">
											เวลารับ
										</th>

										<th style="width: 20%; background-color: white;" colspan="1">
										</th>

									</tr>
								</thead>

								<tbody class="bg-white">
									<?php

									include("../connectdb.php");

									$slcquesql = "SELECT * FROM queue_table
										INNER JOIN user ON user.UID = queue_table.que_owner_UID
										WHERE queue_status = 2
										ORDER BY s_date ASC";
									$resslcque = $conn->query($slcquesql);

									$rowcountq = 1;

									while ($rowque = mysqli_fetch_array($resslcque)) {

										$s_date = date_create($rowque["s_date"]);

									?>
										<tr>
											<td style="border-right: 2px solid rgb(194, 194, 194); border-top: 2px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194);">
												<div class="content">
													<?php echo $rowcountq; ?>
												</div>

											</td>

											<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" style="border-right: 2px solid rgb(194, 194, 194); border-top: 2px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194);">
												<div class="content"><?php echo $rowque["UID"] . " " . $rowque["username"]; ?>
												</div>
											</td>
											<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" style="border-right: 2px solid rgb(194, 194, 194); border-top: 2px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194);">
												<div class="content"><?php echo date_format($s_date, "d/m/Y"); ?>
												</div>
											</td>

											<td style="border-right: 2px solid rgb(194, 194, 194); border-top: 2px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194);">
												<div align="center">
													<a href="listborrowdetail.php?queid=<?php echo $rowque["que_ID"]; ?>">
														<button class="px-4 py-2 rounded-lg " style="background-color: #015C92; color: white;">เรียกดู</button>
													</a>
												</div>
											</td>
										</tr>
									<?php

										$rowcountq++;
									}

									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>

		<input type="radio" id="tabgive" name="mytabs">

		<label for="tabgive" style="font-size: 18px; ">รายการคืนเครื่องมือ</label>

		<div class="tab">

			<div class="test" style=" margin-left: 5%; margin-right: 5%;">
				<div class="flex flex-col">
					<div>
						<div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
							<table class="min-w-full" style="min-width: 100%;  border: 2px solid rgb(194, 194, 194); ">
								<thead>
									<tr>
										<th style="font-weight: medium;
										text-align: center;
										text-transform: uppercase;
										border-right: 2px solid rgb(194, 194, 194);
										width: 10%; font-size: 18px; background-color: white; ">
											คิว
										</th>
										<th style="font-weight: medium;
										text-align: center;
										border-right: 2px solid rgb(194, 194, 194);
										text-transform: uppercase;
										width: 40%; font-size: 18px; background-color: white;">
											รายการคืน
										</th>
										<th style="font-weight: medium;
										text-align: center;
										text-transform: uppercase;
										border-right: 2px solid rgb(194, 194, 194);
										width: 35%; font-size: 18px; background-color:white; ">
											เวลาคืน
										</th>

										<th style="width: 20%; background-color: white;" colspan="1">
										</th>

									</tr>
								</thead>

								<tbody class="bg-white">
									<?php

									$returnsql = "SELECT * FROM queue_table
										INNER JOIN user ON user.UID = queue_table.que_owner_UID
										WHERE queue_status = 6
										ORDER BY e_date ASC";
									$resreturn = $conn->query($returnsql);

									$rowcountr = 1;

									while ($rowreturn = mysqli_fetch_array($resreturn)) {

										$e_date = date_create($rowreturn["e_date"]);

									?>
										<tr>
											<td style="border-right: 2px solid rgb(194, 194, 194); border-top: 2px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194);">
												<div class="content">
													<?php echo $rowcountr; ?>
												</div>

											</td>
											<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" style="border-right: 2px solid rgb(194, 194, 194); border-top: 2px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194);">
												<div class="content"><?php echo $rowreturn["UID"] . " " . $rowreturn["username"]; ?>
												</div>
											</td>
											<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" style="border-right: 2px solid rgb(194, 194, 194); border-top: 2px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194);">
												<div class="content"><?php echo date_format($e_date, "d/m/Y"); ?>
												</div>
											</td>
											<td style="border-right: 2px solid rgb(194, 194, 194); border-top: 2px solid rgb(194, 194, 194); border-bottom: 2px solid rgb(194, 194, 194);">
												<div align="center">
													<a href="listgivedetails.php?queid=<?php echo $rowreturn["que_ID"]; ?>">
														<button class="px-4 py-2 rounded-lg " style="background-color: #015C92; color: white;">เรียกดู</button>
													</a>
												</div>
											</td>
										</tr>
									<?php

										$rowcountr++;
									}

									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button class="px-4 py-2 rounded-lg bg-sky-200 text-sky-100 " style="background-color: #015C92;  color:white; margin-top:2%; margin-left:42%; height:50%;font-size: 18px;" onclick="modaldis()">แสกนคิวอาร์โค้ด</button>

	</div>

	<div id="authenmodal" class="modal">

		<!-- Modal content -->
		<div class="modal-content" style=" width: 40%; margin-left:30%; border-radius: 33px; box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.25);">
			<span class="close" style="margin-left:95%; font-size: 35px;">&times;</span>
			<div>
			</div>
			<video id="vidbox" style="align-self: center;" width="80%" height="80%" autoplay></video>
			<div>
			</div>
		</div>
	</div>

	<?php

	$quedata = "SELECT * FROM queue_table WHERE queue_status = 2";
	$resqdt = $conn->query($quedata);

	$dataset = array();

	while ($qdtrow = mysqli_fetch_array($resqdt)) {

		$nqid = $qdtrow["que_ID"];
		$qown = $qdtrow["que_owner_UID"];

		$dataset[] = array(
			"queid" => $nqid,
			"owner" => $qown
		);
	}

	$jsondata = json_encode($dataset);

	echo "<script>var quedata = " . $jsondata . "</script>";

	?>

	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

	<script>
		var videoElement = document.getElementById("vidbox");
		var constraints = {
			video: true
		};

		var authmodal = document.getElementById("authenmodal");

		var span = document.getElementsByClassName("close")[0];

		var scnr = new Instascan.Scanner({
			video: document.getElementById("vidbox"),
			scanPeriod: 5,
			mirror: false
		});

		function modaldis() {
			authmodal.style.display = "block";
			videoElement.style.display = 'block';
			scnr.addListener('scan', function(content) {
				alert(content);

			});
			Instascan.Camera.getCameras().then(function(cameras) {
				if (cameras.length > 0) {
					scnr.start(cameras[0]);
					$('[name="options"]').on('change', function() {
						if ($(this).val() == 1) {
							if (cameras[0] != "") {
								scnr.start(cameras[0]);
							} else {
								alert('No Front camera found!');
							}
						} else if ($(this).val() == 2) {
							if (cameras[1] != "") {
								scnr.start(cameras[1]);
							} else {
								alert('No Back camera found!');
							}
						}
					});
				} else {
					console.error('No cameras found.');
					alert('No cameras found.');
				}
			}).catch(function(e) {
				console.error(e);
				// alert(e);
			});
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			authmodal.style.display = "none";
			scnr.stop();
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == istmodal) {
				authmodal.style.display = "none";
				scnr.stop();
			}
		}
	</script>
</body>

</html>