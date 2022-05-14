<?php
/**
 * index
 * 
 * @author Javier Gerardo
 */

// fetch bootloader
require('bootloader.php');

try {


    if(!isset($_GET['do'])){
        page_header("Inventario");

        // page footer
        page_footer("index");
    } else{

    }

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}