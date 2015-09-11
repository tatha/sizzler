<?php
/**
************************************************************************
* The Framework
************************************************************************
* Author : Tathagata Basu
* Date   : 21/08/2014
************************************************************************
*/
session_start();
ob_start();
require_once('includes/php_include.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sizzler</title>
<base href="<?php echo APP_ROOT; ?>">
<?php require_once('includes/html_head.php'); ?>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<?php
$param = $_REQUEST;
switch($param['page']) {
	case '': {
		require_once('view/index.php');
		break;
	}
	case 'home': {
		require_once('view/home.php');
		break;
	}
	case 'page1': {
		require_once('view/page1.php');
		break;
	}
	default: {
		if(file_exists('controller/'.$param['page'].'.php')) {
			require_once('controller/'.$param['page'].'.php');
		} else {
			require_once('view/default.php');
		}
	}
}
?>
<?php require_once('includes/footer.php'); ?>
</body>
</html>