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
            $providers = $user->get_providers();
            page_header(SYS_NAME." | Providers");

            $smarty->assign('providers', $providers);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'new':
            page_header(SYS_NAME." | New Provider");

            $smarty->assign('view', $_GET['view']);
            break;

        case 'detail':
            $provider = $user->get_provider($_GET['page']);
            page_header(SYS_NAME." | ".$provider['provider_name']);
            $smarty->assign('provider', $provider);
            $smarty->assign('view', $_GET['view']);
            break;

        default:
            _error(404);
            break;   
    }

    

    // page footer
    page_footer("providers");

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}