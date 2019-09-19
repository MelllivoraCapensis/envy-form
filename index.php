<?php
require_once('Saver.php');

index_controller();

function index_controller() {
	$method = $_SERVER['REQUEST_METHOD'];

	if($method == 'GET') {
		render('template.php');
	}

	if($method == 'POST') {

		if(! isset($_POST['storage'])) {
			http_response_code(400);
		}

		$storage_type = $_POST['storage'];

		$errors = [];		
		try {
			SaverFactory::getSaver($storage_type)->save($_POST);
			json_response(['message' => 'Post is added successfully to ' . $storage_type . '!'], 201);
		} catch (ValidationException $e) {
			foreach ($e->getData() as $key => $value) {
				$errors[$key] = $value;
			}
		} catch (Exception $e) {
			http_response_code(500);
		}

		if($errors) {
			json_response(['errors' => $errors], 200);
		}
	}

	http_response_code(403);
}

//render template with data

function render($template, $data = []) {
	include $template;
}

//making json response

function json_response($body, $status = 200) {
	header('Content-Type: Application/json');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Access-Control-Allow-Credentials: true');
	http_response_code($status);
	echo json_encode($body, JSON_UNESCAPED_UNICODE);
	die();
}

?>
