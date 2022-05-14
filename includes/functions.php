<?php

/* ------------------------------- */
/* Page */
/* ------------------------------- */

/**
 * page_header
 * 
 * @param string $title
 * @param string $description
 * @return void
 */
function page_header($title, $description = '', $image = '')
{
    global $smarty;
    $smarty->assign('page_title', $title);
    $smarty->assign('page_description', $description);
    $smarty->assign('page_image', $image);
}


/**
 * page_footer
 * 
 * @param string $page
 * @return void
 */
function page_footer($page)
{
    global $smarty;
    
    $smarty->assign('page', $page);
    $smarty->display("$page.tpl");
}

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
function _error()
{
    $args = func_get_args();
    if (count($args) > 1 && $args[0] != "BANNED_USER") {
        $title = $args[0];
        $message = $args[1];
    } else {
        switch ($args[0]) {
            case 'DB_ERROR':
                $title = "Database Error";
                $message = "<div class='text-left'><h1>" . "Error establishing a database connection" . "</h1>
                            <p>" . "This either means that the username and password information in your config.php file is incorrect or we can't contact the database server at localhost. This could mean your host's database server is down." . "</p>
                            <ul>
                                <li>" . "Are you sure you have the correct username and password?" . "</li>
                                <li>" . "Are you sure that you have typed the correct hostname?" . "</li>
                                <li>" . "Are you sure that the database server is running?" . "</li>
                            </ul>
                            <p>" . "If you're unsure what these terms mean you should probably contact your host. If you still need help you can always visit the" . " <a href='http://support.zamblek.com'>" . "Sngine Support" . ".</a></p>
                            </div>";
                break;

            case 'SQL_ERROR':
                $title = __("Database Error");
                $message = __("An error occurred while writing to database. Please try again later");
                if (DEBUGGING) {
                    $backtrace = debug_backtrace();
                    $line = $backtrace[0]['line'];
                    $file = $backtrace[0]['file'];
                    $message .= "<br><br><small>This error function was called from line $line in file $file</small>";
                }
                break;

            case 'SQL_ERROR_THROWEN':
                $message = "An error occurred while writing to database. Please try again later";
                if (DEBUGGING) {
                    $backtrace = debug_backtrace();
                    $line = $backtrace[0]['line'];
                    $file = $backtrace[0]['file'];
                    $message .= "<br><br><small>This error function was called from line $line in file $file</small>";
                }
                throw new Exception($message);
                break;

            case 'PERMISSION':
                global $smarty;
                $title = __("Permission Needed");
                $message = __("You do not have the permission to view this content");
                if (isset($smarty)) {
                    $smarty->assign('message', $message);
                    page_header($title);
                    page_footer('permission');
                    exit;
                }
                break;

            case 'BANNED':
                global $smarty;
                $title = __("Banned");
                $message = __("You do not have the permission to view this content");
                if (isset($smarty)) {
                    $smarty->assign('message', $message);
                    page_header($title);
                    page_footer('banned');
                    exit;
                }
                break;

            case 'BANNED_USER':
                global $smarty;
                $title = __("Banned Account");
                $message = $args[1];
                if (isset($smarty)) {
                    $smarty->assign('message', $message);
                    page_header($title);
                    page_footer('banned');
                    exit;
                }
                break;

            case '404':
                global $smarty;
                header('HTTP/1.0 404 Not Found');
                $title = "404 Not Found";
                $message = "Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable";
                if (DEBUGGING) {
                    $backtrace = debug_backtrace();
                    $line = $backtrace[0]['line'];
                    $file = $backtrace[0]['file'];
                    $message .= "<br><br><small>This error function was called from line $line in file $file</small>";
                }
                if (isset($smarty)) {
                    $smarty->assign('message', $message);
                    page_header($title);
                    page_footer('404');
                    exit;
                }
                break;

            case '400':
                header('HTTP/1.0 400 Bad Request');
                if (DEBUGGING) {
                    $backtrace = debug_backtrace();
                    $line = $backtrace[0]['line'];
                    $file = $backtrace[0]['file'];
                    exit("This error function was called from line $line in file $file");
                }
                exit;
                break;

            case '403':
                header('HTTP/1.0 403 Access Denied');
                if (DEBUGGING) {
                    $backtrace = debug_backtrace();
                    $line = $backtrace[0]['line'];
                    $file = $backtrace[0]['file'];
                    exit("This error function was called from line $line in file $file");
                }
                exit;
                break;

            default:
                $title = __("Error");
                $message = __("There is some thing went wrong");
                if (DEBUGGING) {
                    $backtrace = debug_backtrace();
                    $line = $backtrace[0]['line'];
                    $file = $backtrace[0]['file'];
                    $message .= "<br><br>" . "<small>This error function was called from line $line in file $file</small>";
                }
                break;
        }
    }
    echo '<!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <title>' . $title . '</title>
                <style type="text/css">
                    html {
                        background: #f1f1f1;
                    }
                    body {
                        color: #555;
                        font-family: "Open Sans", Arial,sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .error-title {
                        background: #ce3426;
                        color: #fff;
                        text-align: center;
                        font-size: 34px;
                        font-weight: 100;
                        line-height: 50px;
                        padding: 60px 0;
                    }
                    .error-message {
                        margin: 1em auto;
                        padding: 1em 2em;
                        max-width: 600px;
                        font-size: 1em;
                        line-height: 1.8em;
                        text-align: center;
                    }
                    .error-message .code,
                    .error-message p {
                        margin-top: 0;
                        margin-bottom: 1.3em;
                    }
                    .error-message .code {
                        font-family: Consolas, Monaco, monospace;
                        background: rgba(0, 0, 0, 0.7);
                        padding: 10px;
                        color: rgba(255, 255, 255, 0.7);
                        word-break: break-all;
                        border-radius: 2px;
                    }
                    h1 {
                        font-size: 1.2em;
                    }
                    
                    ul li {
                        margin-bottom: 1em;
                        font-size: 0.9em;
                    }
                    a {
                        color: #ce3426;
                        text-decoration: none;
                    }
                    a:hover {
                        text-decoration: underline;
                    }
                    .button {
                        background: #f7f7f7;
                        border: 1px solid #cccccc;
                        color: #555;
                        display: inline-block;
                        text-decoration: none;
                        margin: 0;
                        padding: 5px 10px;
                        cursor: pointer;
                        -webkit-border-radius: 3px;
                        -webkit-appearance: none;
                        border-radius: 3px;
                        white-space: nowrap;
                        -webkit-box-sizing: border-box;
                        -moz-box-sizing:    border-box;
                        box-sizing:         border-box;

                        -webkit-box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0,0,0,.08);
                        box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0,0,0,.08);
                        vertical-align: top;
                    }

                    .button.button-large {
                        height: 29px;
                        line-height: 28px;
                        padding: 0 12px;
                    }

                    .button:hover,
                    .button:focus {
                        background: #fafafa;
                        border-color: #999;
                        color: #222;
                        text-decoration: none;
                    }

                    .button:focus  {
                        -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,.2);
                        box-shadow: 1px 1px 1px rgba(0,0,0,.2);
                    }

                    .button:active {
                        background: #eee;
                        border-color: #999;
                        color: #333;
                        -webkit-box-shadow: inset 0 2px 5px -3px rgba( 0, 0, 0, 0.5 );
                        box-shadow: inset 0 2px 5px -3px rgba( 0, 0, 0, 0.5 );
                    }
                    .text-left {
                        text-align: left;
                    }
                    .text-center {
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="error-title">' . $title . '</div>
                <div class="error-message">' . $message . '</div>
            </body>
            </html>';
    exit;
}

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
?>