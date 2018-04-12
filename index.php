<?php
session_start();
include_once 'scripts/core.php';

$url_string = $_SERVER['REQUEST_URI'];

$url_array = explode("/", $url_string);

$page = "dashboard";

switch ($url_array[3]) {
	case 'welcome':
		$page = "welcome";
		break;
	case 'dashboard':
		$page = "dashboard";
		break;
	default:
		$page = "dashboard";
		break;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Blogger</title>
</head>
<body>
	<?php include_once "views/" . $page . ".php"; ?>
</body>
</html>