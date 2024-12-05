<?php

/**
 * sign
 * 
 * @package Sngine
 * @author Zamblek
 */

// fetch bootloader
require('bootloader.php');

	// if($config['install'] ==0){

		// page header
		// page_header(SYS_NAME." | Install");

		// page footer
		// page_footer("install");

		define('SYS_TITLE_PAGE', 'Install');

		include 'views/install.php';

	// } else {
	// 	redirect("/signin");
	// }