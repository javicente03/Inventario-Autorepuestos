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
                        $sales = $user->get_sales($_GET['page'], $_GET['type']);
                        break;

                    default:
                        _error('404');
                        break;
                }
            } else
                $sales = $user->get_sales();

            page_header(SYS_NAME." | Sales");

            $smarty->assign('get', $_GET);
            $smarty->assign('sales', $sales);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'new':
            page_header(SYS_NAME." | New Purchase");
            $sale = $user->new_sale();
            redirect('/sales/edit/'.$sale['sale_id']);
            break;

        case 'edit':
            if(!isset($_GET['page']))
                _error("404");

            page_header(SYS_NAME." | Purchase ".$_GET['page']);
            $sale = $user->get_sale($_GET['page']);
            if($sale['sale_status'])
                redirect("/sales/detail/".$sale['sale_id']);

            $details = $user->get_details_sale($_GET['page']);
            $sum_details = $user->get_sum_details_sale($_GET['page']);
            $clients = $user->get_clients();
            $categories = $user->get_categories();
            $products = $user->get_products($config['tasa_dolar'], ' WHERE product_quantity > 0');

            $smarty->assign('sale', $sale);
            $smarty->assign('details', $details);
            $smarty->assign('sum_details', $sum_details);
            $smarty->assign('products', $products);
            $smarty->assign('categories', $categories);
            $smarty->assign('clients', $clients);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'detail':
            $sale = $user->get_sale($_GET['page']);
            $details = $user->get_details_sale($_GET['page']);
            if(!$sale['sale_status'])
                redirect("/sales/edit/".$sale['sale_id']);

            page_header(SYS_NAME." | ".$sale['sale_id']);
            $smarty->assign('sale', $sale);
            $smarty->assign('details', $details);
            $smarty->assign('view', $_GET['view']);
            break;

        default:
            _error(404);
            break;   
    }

    

    // page footer
    page_footer("sales");

} catch (Exception $e) {
	_error('404');
}