<?php 
//include ('GoogleOpenID.php');

	$googleLogin = GoogleOpenID::getResponse();
	if ($googleLogin->success()){
		$user_id = $googleLogin->identity();
		include ('list.php');
	}

?>

