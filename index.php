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

        global $db;
        // page_header(SYS_NAME." | Dashboard");

        $conts = [];

        $mas_vendidos = [];
        $get_vendidos = $db->query("SELECT *, sum(sale_detail.detail_quantity) AS suma FROM products LEFT JOIN sale_detail ON products.product_id = sale_detail.detail_product LEFT JOIN sales ON sale_detail.sale_id = sales.sale_id LEFT JOIN categories ON products.product_category = categories.category_id WHERE sales.sale_status = 1 GROUP BY products.product_id ORDER BY `suma` DESC LIMIT 10 ");

        while($row = $get_vendidos->fetch_assoc()){
            $mas_vendidos[] = $row;
        }

        $proveedores_constantes = [];
        $get_proveedores = $db->query("SELECT *, COUNT(*) AS count FROM purchases LEFT JOIN providers ON purchases.purchase_provider = providers.provider_id WHERE purchases.purchase_status = true GROUP BY providers.provider_id ORDER BY count DESC LIMIT 5");

        while($row = $get_proveedores->fetch_assoc()){
            $proveedores_constantes[] = $row;
        }

        $productos_poco_stock = [];
        $get_poco_stock = $db->query("SELECT * FROM products WHERE product_quantity < 5 ORDER BY product_quantity DESC");
        $conts['poco_stock'] = $get_poco_stock->num_rows;

        while($row = $get_poco_stock->fetch_assoc()){
            $productos_poco_stock[] = $row;
        }

        define('SYS_TITLE_PAGE', 'Dashboard');

        include 'views/index.php';

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}