<?php
/**
 * index
 * 
 * @author Javier Gerardo
 */

// fetch bootloader
require('bootloader.php');

if (!$user->_logged_in) {
    redirect('/signin');
}

try {

    page_header(SYS_NAME." | Tasa del dólar");

    $smarty->assign('tasa', $config['tasa_dolar']);
    // page footer
    page_footer("dolar");

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}