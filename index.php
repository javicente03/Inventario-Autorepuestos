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

        page_header(SYS_NAME." | Dashboard");


        // page footer
        page_footer("index");

} catch (Exception $e) {
	_error(__("Error"), $e->getMessage());
}