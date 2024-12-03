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

    switch($_GET['view']){
        case 'list':
            $clients = $user->get_clients();
            page_header(SYS_NAME." | Clientes");

            $smarty->assign('clients', $clients);
            $smarty->assign('view', $_GET['view']);
            break;

        default:
            _error(404);
            break;   
    }

    

    // page footer
    page_footer("clients");

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}