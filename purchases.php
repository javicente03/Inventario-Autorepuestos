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
            if(isset($_GET['page'])){
                if(!isset($_GET['type']))
                    _error('404');

                switch($_GET['type']){
                    case 'status':
                        $purchases = $user->get_purchases($_GET['page'], $_GET['type']);
                        break;
                    case 'type':
                        $purchases = $user->get_purchases($_GET['page'], $_GET['type']);
                        break;
                    default:
                        _error('404');
                        break;
                }
            } else
                $purchases = $user->get_purchases();

            page_header(SYS_NAME." | Purchases");

            $smarty->assign('get', $_GET);
            $smarty->assign('purchases', $purchases);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'new':
            page_header(SYS_NAME." | New Purchase");
            $purchase = $user->new_purchase();
            redirect('/purchases/edit/'.$purchase['purchase_id']);
            break;

        case 'edit':
            if(!isset($_GET['page']))
                _error("404");

            page_header(SYS_NAME." | Purchase ".$_GET['page']);
            $purchase = $user->get_purchase($_GET['page']);
            if($purchase['purchase_status'])
                redirect("/purchases/detail/".$purchase['purchase_id']);

            $details = $user->get_details_purchase($_GET['page']);
            $sum_details = $user->get_sum_details_purchase($_GET['page']);
            $providers = $user->get_providers();
            $categories = $user->get_categories();
            $products = $user->get_products($config['tasa_dolar']);

            $smarty->assign('purchase', $purchase);
            $smarty->assign('details', $details);
            $smarty->assign('sum_details', $sum_details);
            $smarty->assign('products', $products);
            $smarty->assign('categories', $categories);
            $smarty->assign('providers', $providers);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'detail':
            $purchase = $user->get_purchase($_GET['page']);
            $details = $user->get_details_purchase($_GET['page']);
            if(!$purchase['purchase_status'])
                redirect("/purchases/edit/".$purchase['purchase_id']);

            page_header(SYS_NAME." | ".$purchase['purchase_id']);
            $smarty->assign('purchase', $purchase);
            $smarty->assign('details', $details);
            $smarty->assign('view', $_GET['view']);
            break;

        default:
            _error(404);
            break;   
    }

    

    // page footer
    page_footer("purchases");

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}