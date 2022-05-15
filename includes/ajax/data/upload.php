<?php

/**
 * ajax -> core -> signup
 * 
 * @package Sngine
 * @author Zamblek
 */

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: content-type");
// header("Access-Control-Allow-Methods: OPTIONS,GET,PUT,POST,DELETE");

// fetch bootstrap
require('../../../bootstrap.php');

// check AJAX Request
is_ajax();

// check user logged in
if (!$user->_logged_in) {
	return_json(array('callback' => 'window.location.reload();'));
}

// check type
if (!isset($_POST["type"])) {
    _error(403);
}

// check handle
if (!isset($_POST["handle"])) {
    _error(403);
}

// check if registration is open
// if (!$system['registration_enabled']) {
// 	return_json(array('error' => true, 'message' => __('Registration is closed right now')));
// }

// check honeypot
// if (!is_empty($_POST['field1'])) {
// 	return_json();
// }

try {

	switch($_POST['type']){
        case 'video':
            $folder = 'video';
            $directory = $folder . '/' . date('Y') . '/' . date('m') . '/';

            // valid inputs
            if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != UPLOAD_ERR_OK) {
                return_json(array('error' => true, 'message' => 'Sorry, an error has occurred'));
            }

            // check file extesnion
            $extension = get_extension($_FILES['file']['name']);
            if (!valid_extension($extension, 'mp4, mkv, flv, avi, mov, wmv')) {
                return_json(array('error' => true, 'message' => 'Invalid format'));
            }

            $prefix = "Casper". get_hash_token();
            $file_name = $directory . $prefix . '.' . $extension;
            $uploads_directory = "content/uploads";
            $path = ABSPATH . $uploads_directory . '/' . $file_name;


            /* local server */
                /* set uploads directory */
                if (!file_exists(ABSPATH . $uploads_directory . '/' . $folder)) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder, 0777, true);
                }
                if (!file_exists(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y'))) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y'), 0777, true);
                }
                if (!file_exists($uploads_directory . '/' . $folder . '/' . date('Y') . '/' . date('m'))) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y') . '/' . date('m'), 0777, true);
                }
                /* check if the file uploaded successfully */
                if (!@move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                    return_json(array('error' => true, 'message' => 'Sorry, the file could not be uploaded'));
                }            
            break;

		case 'photo':
			$folder = 'photos';
            $directory = $folder . '/' . date('Y') . '/' . date('m') . '/';

            // valid inputs
            if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != UPLOAD_ERR_OK) {
                return_json(array('error' => true, 'message' => 'Sorry, an error has occurred'));
            }

            // check file extesnion
            $extension = get_extension($_FILES['file']['name']);
            if (!valid_extension($extension, 'jpg, png, gif')) {
				return_json(array('error' => true, 'message' => 'Invalid format'));
            }

			$prefix = "Casper". get_hash_token();
            $file_name = $directory . $prefix . '.' . $extension;
            $uploads_directory = "content/uploads";
            $path = ABSPATH . $uploads_directory . '/' . $file_name;


            /* local server */
                /* set uploads directory */
                if (!file_exists(ABSPATH . $uploads_directory . '/' . $folder)) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder, 0777, true);
                }
                if (!file_exists(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y'))) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y'), 0777, true);
                }
                if (!file_exists($uploads_directory . '/' . $folder . '/' . date('Y') . '/' . date('m'))) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y') . '/' . date('m'), 0777, true);
                }
                /* check if the file uploaded successfully */
                if (!@move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                    return_json(array('error' => true, 'message' => 'Sorry, the file could not be uploaded'));
                }            
			break;

		case 'audio':
			// prepare uploads directory
            $folder = 'music';
            $directory = $folder . '/' . date('Y') . '/' . date('m') . '/';

            // valid inputs
            if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != UPLOAD_ERR_OK) {
                return_json(array('error' => true, 'message' => 'Sorry, an error has occurred'));
            }

            // check file extesnion
            $extension = get_extension($_FILES['file']['name']);
            if (!valid_extension($extension, 'mp3, wav, ogg')) {
				return_json(array('error' => true, 'message' => 'Invalid format'));
            }

            $prefix = "Casper". get_hash_token();
            $file_name = $directory . $prefix . '.' . $extension;
            $uploads_directory = "content/uploads";
            $path = ABSPATH . $uploads_directory . '/' . $file_name;


            /* local server */
                /* set uploads directory */
                if (!file_exists(ABSPATH . $uploads_directory . '/' . $folder)) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder, 0777, true);
                }
                if (!file_exists(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y'))) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y'), 0777, true);
                }
                if (!file_exists($uploads_directory . '/' . $folder . '/' . date('Y') . '/' . date('m'))) {
                    @mkdir(ABSPATH . $uploads_directory . '/' . $folder . '/' . date('Y') . '/' . date('m'), 0777, true);
                }
                /* check if the file uploaded successfully */
                if (!@move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                    return_json(array('error' => true, 'message' => 'Sorry, the file could not be uploaded'));
                }
            break;
	}
		
    return_json(array("file" => $file_name));
} catch (Exception $e) {
	return_json(array('error' => true, 'message' => $e->getMessage()));
}
