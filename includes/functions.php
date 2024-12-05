<?php

/* ------------------------------- */
/* Page */
/* ------------------------------- */


/**
 * get_hash_token
 * 
 * @return string
 */
function get_hash_token()
{
    return md5(get_hash_number());
}

/**
 * get_hash_number
 * 
 * @return string
 */
function get_hash_number()
{
    return time() * rand(1, 99999);
}

/* ------------------------------- */
/* JSON */
/* ------------------------------- */

/**
 * return_json
 * 
 * @param array $response
 * @return json
 */
function return_json($response = [])
{
    header('Content-Type: application/json');
    exit(json_encode($response));
}

/* ------------------------------- */
/* Error */
/* ------------------------------- */

/**
 * _error
 * 
 * @return void
 */

/**
 * is_empty
 * 
 * @param string $value
 * @return boolean
 */
function is_empty($value)
{
    if (strlen(trim(preg_replace('/\xc2\xa0/', ' ', $value))) == 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * valid_email
 * 
 * @param string $email
 * @return boolean
 */
function valid_email($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        return true;
    } else {
        return false;
    }
}

/**
 * valid_username
 * 
 * @param string $username
 * @return boolean
 */
function valid_username($username)
{
    if (strlen($username) >= 3 && preg_match('/^[a-zA-Z0-9]+([_|.]?[a-zA-Z0-9])*$/', $username)) {
        return true;
    } else {
        return false;
    }
}

/* ------------------------------- */
/* Security */
/* ------------------------------- */

/**
 * secure
 * 
 * @param string $value
 * @param string $type
 * @param boolean $quoted
 * @return string
 */
function secure($value, $type = "", $quoted = true)
{
    global $db;
    if ($value !== 'null') {
        // [1] Sanitize
        /* Convert all applicable characters to HTML entities */
        $value = htmlentities($value, ENT_QUOTES, 'utf-8');
        // [2] Safe SQL
        $value = $db->real_escape_string($value);
        switch ($type) {
            case 'int':
                $value = ($quoted) ? "'" . intval($value) . "'" : intval($value);
                break;
            case 'datetime':
                $value = ($quoted) ? "'" . set_datetime($value) . "'" : set_datetime($value);
                break;
            case 'search':
                if ($quoted) {
                    $value = (!is_empty($value)) ? "'%" . $value . "%'" : "''";
                } else {
                    $value = (!is_empty($value)) ? "'%%" . $value . "%%'" : "''";
                }
                break;
            default:
                $value = (!is_empty($value)) ? $value : "";
                $value = ($quoted) ? "'" . $value . "'" : $value;
                break;
        }
    }
    return $value;
}

/**
 * redirect
 * 
 * @param string $url
 * @return void
 */
function redirect($url = '')
{
    if ($url) {
        header('Location: ' . SYS_URL . $url);
    } else {
        header('Location: ' . SYS_URL);
    }
    exit;
}



/* ------------------------------- */
/* Validation */
/* ------------------------------- */

/**
 * is_ajax
 * 
 * @return void
 */
function is_ajax()
{
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {
        redirect();
    }
}

/**
 * reserved_username
 * 
 * @param string $username
 * @return boolean
 */
function reserved_username($username)
{
    $reserved_usernames = array('install', 'static', 'contact', 'contacts', 'sign', 'signin', 'login', 'signup', 'register', 'signout', 'logout', 'reset', 'activation', 'connect', 'revoke', 'packages', 'started', 'search', 'friends', 'messages', 'message', 'notifications', 'notification', 'settings', 'setting', 'posts', 'post', 'photos', 'photo', 'create', 'pages', 'page', 'groups', 'group', 'events', 'event', 'games', 'game', 'saved', 'forums', 'forum', 'blogs', 'blog', 'articles', 'article', 'directory', 'products', 'product', 'market', 'admincp', 'admin', 'admins', 'modcp', 'moderator', 'moderators', 'moderatorcp', 'chat', 'ads', 'wallet', 'boosted', 'people', 'popular', 'movies', 'movie',  'api', 'apis', 'oauth', 'authorize', 'anonymous', 'jobs', 'job');
    if (in_array(strtolower($username), $reserved_usernames)) {
        return true;
    } else {
        return false;
    }
}

/**
 * valid_url
 * 
 * @param string $url
 * @return boolean
 */
function valid_url($url)
{
    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
        return true;
    } else {
        return false;
    }
}

/**
 * valid_name
 * 
 * @param string $name
 * @return boolean
 */
function valid_name($name)
{
    if (preg_match('/[[:punct:]]/i', $name) || valid_url($name)) {
        return false;
    }
    return true;
}

/**
 * _password_hash
 * 
 * @param string $password
 * @return string
 */
function _password_hash($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * get_system_protocol
 * 
 * @return string
 */
function get_system_protocol()
{
    $is_secure = false;
    if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
        $is_secure = true;
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
        $is_secure = true;
    }
    return $is_secure ? 'https' : 'http';
}

/**
 * get_extension
 * 
 * @param string $path
 * @return string
 */
function get_extension($path)
{
    return strtolower(pathinfo($path, PATHINFO_EXTENSION));
}

/**
 * valid_extension
 * 
 * @param string $extension
 * @param array $allowed_extensions
 * @return boolean
 */
function valid_extension($extension, $allowed_extensions)
{
    $extensions = explode(',', $allowed_extensions);
    foreach ($extensions as $key => $value) {
        $extensions[$key] = strtolower(trim($value));
    }
    if (is_array($extensions) && in_array($extension, $extensions)) {
        return true;
    }
    return false;
}


/**
 * 
 * valid_category
 * */

function valid_category($id){
    global $db;

    $get_category = $db->query("SELECT * FROM categories WHERE category_id = ".$id);
    if($get_category->num_rows> 0)
        return true;
    else
        return false;
}

/**
 * 
 * get_tasa
 * 
 * */

function get_tasa(){
    global $db;

    $get_tasa = ($db->query("SELECT * FROM system_option WHERE option_name = 'tasa_dolar'"))->fetch_assoc();
    $tasa = $get_tasa['option_value']; 
    return $tasa;   
}

/**
 * 
 * check_stock
 * @param int
 * @param int
 * @return boolean
 * 
 * */

function check_stock($cantidad, $product_id){
    global $db;

    $get_product = $db->query("SELECT product_quantity FROM products WHERE product_id = $product_id");
    $stock = $get_product->fetch_assoc();

    if($cantidad > $stock['product_quantity']){
        $response = [false, $stock['product_quantity']];
        return $response;
    }
    else{
        $response = [true, false];
        return $response;
    }
}

?>