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
            $categories = $user->get_categories();
            page_header(SYS_NAME." | Categories");

            $smarty->assign('categories', $categories);
            $smarty->assign('view', $_GET['view']);
            break;

        case 'new':
            page_header(SYS_NAME." | New Category");

            $smarty->assign('view', $_GET['view']);
            break;

        case 'detail':
            $category = $user->get_category($_GET['page']);
            page_header(SYS_NAME." | ".$category['category_name']);
            $smarty->assign('category', $category);
            $smarty->assign('view', $_GET['view']);
            break;

        default:
            _error(404);
            break;   
    }

    

    // page footer
    page_footer("categories");

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}