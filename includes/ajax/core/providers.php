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

	switch ($_GET['do']) {
		case 'new':
			$user->register_provider($_POST);
			return_json(array('callback' => "M.toast({html: 'Proveedor registrado exitósamente', classes: 'rounded green'}); form.reset()"));
			break;

		case 'edit':
			if(!isset($_GET['id']) || !is_numeric($_GET['id']))
				return_json(array('error' => true, 'message' => 'Data inválida, por favor recargue la página'));

			$user->edit_provider($_POST, $_GET['id']);
			return_json(array('callback' => "M.toast({html: 'Proveedor modificado exitósamente', classes: 'rounded green'})"));
			break;

		case 'delete':
			if(!isset($_GET['id']) || !is_numeric($_GET['id']))
				return_json(array('error' => true, 'message' => 'Data inválida, por favor recargue la página'));

			$user->delete_provider($_GET['id']);
			return_json(array('callback' => "location.href=''"));
			break;
		default:
			// code...
			break;
	}
	//return_json(array('callback' => "window.location = ".$rut));
} catch (Exception $e) {
	return_json(array('error' => true, 'message' => $e->getMessage()));
}
