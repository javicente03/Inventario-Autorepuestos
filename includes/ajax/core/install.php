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
if ($user->_logged_in) {
	return_json(array('callback' => 'window.location.reload();'));
}


try {

	// signup
	$user->sign_up($_POST, true);
	return_json(array('callback' => 'location.href = "signin";'));
	//return_json(array('callback' => "window.location = ".$rut));
} catch (Exception $e) {
	return_json(array('error' => true, 'message' => $e->getMessage()));
}
