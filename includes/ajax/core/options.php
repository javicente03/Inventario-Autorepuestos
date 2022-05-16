<?php

/**
 * ajax -> core -> signup
 * 
 * @package Sngine
 * @author Zamblek
 */

// fetch bootstrap
require('../../../bootstrap.php');

// check AJAX Request
is_ajax();

// check user logged in
if (!$user->_logged_in) {
	return_json(array('callback' => 'window.location.reload();'));
}


try {

	// signup
	switch ($_GET['do']) {

		case 'dolar':
			if(!isset($_POST['dolar']))
				return_json(array('error' => true, 'message' => 'Recargue la página por favor'));

			if($_POST['dolar'] =="")
				return_json(array('error' => true, 'message' => 'Ingrese la tasa'));

			if(!is_numeric($_POST['dolar']))
				return_json(array('error' => true, 'message' => 'La tasa debe ser numérico'));

			if($_POST['dolar'] <= 0)
				return_json(array('error' => true, 'message' => 'Debe ser mayor a 0'));

			global $db;

			$db->query("UPDATE system_option SET option_value = ".$_POST['dolar']." WHERE option_name = 'tasa_dolar'");

			return_json(array('callback' => "location.href = ''"));
			break;
		default:
			// code...
			break;
	}
	//return_json(array('callback' => "window.location = ".$rut));
} catch (Exception $e) {
	return_json(array('error' => true, 'message' => $e->getMessage()));
}
