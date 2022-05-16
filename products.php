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

        case 'edit':
            if(!isset($_GET['page']))
                _error('404');

            $product = $user->get_product($_GET['page']);

            if(!$product)
                _error('404');

            page_header(SYS_NAME.' | '.$product['product_name']);

            $categories = $user->get_categories();

            $smarty->assign('categories', $categories);
            $smarty->assign('product', $product);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'detail':
            if(!isset($_GET['page']))
                _error('404');

            $product = $user->get_product($_GET['page']);

            if(!$product)
                _error('404');

            page_header(SYS_NAME.' | '.$product['product_name']);

            $conts = [];

            $count_purchases = $db->query("SELECT COUNT(*) AS count FROM purchase_detail LEFT JOIN purchases ON purchase_detail.purchase_id = purchases.purchase_id WHERE detail_product = ".$product['product_id']." AND purchase_status = true");
            $conts['purchases_count'] = $count_purchases->fetch_assoc()['count'];

            $get_purchases = $db->query("SELECT * FROM purchase_detail LEFT JOIN purchases ON purchase_detail.purchase_id = purchases.purchase_id LEFT JOIN providers ON purchases.purchase_provider = providers.provider_id WHERE detail_product = ".$product['product_id']." AND purchase_status = true");

            $purchases = [];
            while($row = $get_purchases->fetch_assoc()){
                $purchases[] = $row;
            }

            $count_sales = $db->query("SELECT COUNT(*) AS count FROM sale_detail LEFT JOIN sales ON sale_detail.sale_id = sales.sale_id WHERE detail_product = ".$product['product_id']." AND sale_status = true");
            $conts['sales_count'] = $count_sales->fetch_assoc()['count'];

            $get_sales = $db->query("SELECT * FROM sale_detail LEFT JOIN sales ON sale_detail.sale_id = sales.sale_id LEFT JOIN clients ON sales.sale_client = clients.client_id WHERE detail_product = ".$product['product_id']." AND sale_status = true");

            $sales = [];
            while($row = $get_sales->fetch_assoc()){
                $sales[] = $row;
            }

            $smarty->assign('product', $product);
            $smarty->assign('conts', $conts);
            $smarty->assign('purchases', $purchases);
            $smarty->assign('sales', $sales);
            $smarty->assign('view', $_GET['view']);
            break;

        default:
            _error(404);
            break;   
    }

    

    // page footer
    page_footer("products");

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}