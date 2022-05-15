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
            $products = $user->get_products($config['tasa_dolar']);
            page_header(SYS_NAME." | Products");

            $smarty->assign('products', $products);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'new':
            $categories = $user->get_categories();
            page_header(SYS_NAME." | New Product");

            $smarty->assign('categories', $categories);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'details':
            // $messages = $user->get_messages(true);
            break;

        default:
            // _error(404);
            break;   
    }

    

    // page footer
    page_footer("products");

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}