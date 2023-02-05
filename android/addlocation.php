<?php
    include('connectdb.php');
	 
	// json response array
	$response = array();

		// receiving the post params
		$uid = $_POST['uid'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];

		$locationupdate = "UPDATE user SET
			act_la = '$latitude',
			act_lo = '$longitude'
			WHERE UID = '$uid'";
		$result = $conn->query($locationupdate);

		if ($result) {
			$response["error"] = true;
			echo json_encode($response);
		} else {
			$response["error"] = false;
			echo json_encode($response);
		}
