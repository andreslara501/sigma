<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json;charset=utf-8');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

	$post_values 				= json_decode(file_get_contents('php://input'), true);

	if($post_values["token"]!='dvpitfoclvkbmmwnwgyolkfyqqdqvgcm'){
		exit();
	}

	$conn = new mysqli("178.128.146.252", "admin_sigmauser", "pfaDKIJyPF", "admin_sigmatest");

	if ($conn->connect_error) {
		echo json_encode(array("response" => false, "error" -> $conn -> connect_error));
	}

	$result = $conn -> query("
		INSERT INTO `contacts`
			(
				`name`,
				`email`,
				`state`,
				`city`
			)
			VALUES
			(
				'{$post_values["name"]}',
				'{$post_values["email"]}',
				'{$post_values["state"]}',
				'{$post_values["city"]}'
			);
		"
	);

	echo json_encode(array("response" => true));
 ?>