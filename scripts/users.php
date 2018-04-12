<?php
session_start();
include_once 'core.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	switch ($_POST['user_form']) {
		case 'login':
			$error = false;
			if ($_POST['email'] == "") {
				$_SESSION['l_email_em'] = 1;
				$error = true;
			}
			if ($_POST['password'] == "") {
				$_SESSION['l_pass'] = 1;
				$error = true;
			}
			if ($error == false) {
				$fields = array(
					"email" => $_POST['email'],
					"password" => md5($_POST['password'])
				);
				$result = read("users",$fields);
				if ($result == false) {
					$_SESSION['l_not'] = 1;
					header('Location: ' . $host . '/index.php/welcome');
					exit;
				}
				//set session variables
				$_SESSION['user_id'] = $result['id'];
				$_SESSION['email'] = $result['email'];
				$_SESSION['name'] = $result['name'];
				header('Location: ' . $host . '/index.php/dashboard');
				exit;
			}

		break;

		case 'signup':
		$error = false;
		if ($_POST['name'] == "") {
			$_SESSION['s_name'] = 1;
			$error = true;
		}
		if ($_POST['email'] == "") {
			$_SESSION['s_email_em'] = 1;
			$error = true;
		}
		if ($_POST['password'] != $_POST['password_confirmation']) {
			$_SESSION['s_pass_comb'] = 1;
			$error = true;
		}
		//before saving check validations
		if ($error == false) {
			$fields = array(
				"name" => $_POST['name'],
				"email" => $_POST['email'],
				"password" => md5($_POST['password'])
			);
			$result = create("users",$fields);
			if ($result == true) {
				//set session variables
				$_SESSION['user_id'] = $conn->insert_id;
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['name'] = $_POST['name'];
				header('Location: ' . $host . '/index.php/dashboard');
				exit;
			}
			$_SESSION['s_email'] = 1;
			header('Location: ' . $host . '/index.php/welcome');
			exit;
		}
		header('Location: ' . $host . '/index.php/welcome');
		exit;
		break;
	}
}