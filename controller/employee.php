<?php

require_once('model/'.$param['page'].'.php');
$employeeInst = new employee;
switch($param['action']) {
	case '': {
		$employees = $employeeInst->FetchList();
		require_once('view/employee/employee_list.php');
		break;
	}
	case 'add': {
		require_once('view/employee/employee_form.php');
		break;
	}
	case 'edit': {
		$employee = $employeeInst->GetDetails($param['value']);
		require_once('view/employee/employee_form.php');
		break;
	}
	case 'save': {
		$employee = $_REQUEST['employee'];
		if($employeeInst->Save($employee)) {
			$_SESSION['employee']['list']['status'] = "success";
			$_SESSION['employee']['list']['msg'] = "Employee saved successfully";
		} else {
			$_SESSION['employee']['list']['status'] = "error";
			$_SESSION['employee']['list']['msg'] = "Failed to save employee";
		}
		header("Location:".APP_ROOT."employee");
		break;
	}
	case 'delete': {
		$e_id = $param['value'];
		if($employeeInst->Delete($e_id)) {
			$_SESSION['employee']['list']['status'] = "success";
			$_SESSION['employee']['list']['msg'] = "Employee deleted successfully";
		} else {
			$_SESSION['employee']['list']['status'] = "error";
			$_SESSION['employee']['list']['msg'] = "Failed to delete employee";
		}
		header("Location:".APP_ROOT."employee");
		break;
	}
	default: {
		require_once('view/default.php');
	}
}
?>