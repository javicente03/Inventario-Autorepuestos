<?php

/**
 * bootstrap
 * 
 * @package Sngine
 * @author Zamblek
 */

// set system version
define('SYS_VER', '3.4');


// set absolut & base path
define('ABSPATH', dirname(__FILE__) . '/');
define('BASEPATH', dirname($_SERVER['PHP_SELF']));

// check the config file
//if (!file_exists(ABSPATH . 'includes/config.php')) {
    /* the config file doesn't exist -> start the installer */
/*    header('Location: ./install');
}*/


// get system configurations
require_once(ABSPATH . 'includes/config.php');

// get functions
require_once(ABSPATH . 'includes/functions.php');


session_start();
/* set session secret */
if (!isset($_SESSION['secret'])) {
    $_SESSION['secret'] = get_hash_token();
}


// time config
date_default_timezone_set('UTC');
$time = time();
$minutes_to_add = 0;
$DateTime = new DateTime();
$DateTime->add(new DateInterval('PT' . $minutes_to_add . 'M'));
$date = $DateTime->format('Y-m-d H:i:s');

// requerir dotenv
require_once(ABSPATH . 'includes/libs/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// define("DB_NAME", $_ENV['DB_NAME']);
// define("DB_USER", $_ENV['DB_USER']);
// define("DB_PASSWORD", $_ENV['DB_PASSWORD']);
// define("DB_HOST", $_ENV['DB_HOST']);
// define("DB_PORT", $_ENV['DB_PORT']);
// define("SYS_URL", $_ENV['SYS_URL']);
// define("DEBUGGING", $_ENV['DEBUGGING']);
// define("DEFAULT_LOCALE", $_ENV['DEFAULT_LOCALE']);
// define("LICENCE_KEY", $_ENV['LICENCE_KEY']);
// define("SYS_NAME", $_ENV['SYS_NAME']);
// connect to the database
// $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
// $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME'], $_ENV['DB_PORT']);

define("DB_NAME", "railway");
define("DB_USER", "root");
define("DB_PASSWORD", "HDflFYbxahQLQQXpeRNBVsJLJnKwRTAK");
define("DB_HOST", "junction.proxy.rlwy.net");
define("DB_PORT", "33064");
define("SYS_URL", "https://inventario-autorepuestos-production.up.railway.app");
define("DEBUGGING", "false");
define("DEFAULT_LOCALE", "en_us");
define("LICENCE_KEY", "");
define("SYS_NAME", "Autorepuestos_Casper");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

echo phpinfo();

$db->set_charset('utf8mb4');
if (mysqli_connect_error()) {
    _error("DB_ERROR");
}
/* set db time to UTC */
$db->query("SET time_zone = '+0:00'");

// smarty config
require_once(ABSPATH . 'includes/libs/Smarty/Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = ABSPATH . 'content/themes/default/templates';
$smarty->compile_dir = ABSPATH . 'content/themes/default/templates_compiled';
$smarty->loadFilter('output', 'trimwhitespace');


// get user
require_once(ABSPATH . 'includes/class-user.php');
try {
    $user = new User();
    /* assign variables */
    $smarty->assign('user', $user);
} catch (Exception $e) {
    _error(__("Error"), $e->getMessage());
}


// check if the viewer is banned
// if ($user->_logged_in && (!$user->_is_admin && $user->_data['user_banned'])) {
//     $ban_message = ($user->_data['user_banned_message']) ? $user->_data['user_banned_message'] : __("Your account has been blocked");
//     _error(__("System Message"), $ban_message);
// }



// assign system varibles
$config = $user->get_config();
$smarty->assign('config', $config);
$smarty->assign('secret', $_SESSION['secret']);
$smarty->assign('date', $date);
$smarty->assign('base_url', SYS_URL);