<?php
/**
 * sign
 * 
 * @package Sngine
 * @author Zamblek
 */

// fetch bootloader
require('bootloader.php');

if ($config['install'] == 0) {
    /* the config file doesn't exist -> start the installer */
    redirect('/install');
}

switch ($_GET['do']) {
	case 'in':
		// check user logged in
		if ($user->_logged_in) {
			redirect();
		}

		// // assign varible

        define('SYS_TITLE_PAGE', 'Iniciar Sesión');

        define('do_as', $_GET['do']);

        include 'views/sign/signin.php';
		break;

	case 'out':
		// check user logged in
		if (!$user->_logged_in) {
			redirect();
		}

		// sign out
		$user->sign_out();
		redirect();
		break;
	default:
		_error(404);
		break;
}