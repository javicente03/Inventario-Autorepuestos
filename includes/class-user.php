<?php

/**
 * class -> user
 * 
 * @package Sngine
 * @author Zamblek
 */

class User
{

    public $_logged_in = false;
    // public $username = "";
    // public $_is_admin = false;

    private $_cookie_user_id = "c_user";
    private $_cookie_user_token = "xs";
    private $_cookie_user_referrer = "ref";

    /* ------------------------------- */
    /* __construct */
    /* ------------------------------- */

    /**
     * __construct
     * 
     * @return void
     */
    public function __construct()
    {
        global $db, $system;
        if (isset($_COOKIE[$this->_cookie_user_id]) && isset($_COOKIE[$this->_cookie_user_token])) {
            $get_user = $db->query(sprintf("SELECT * FROM users WHERE user_id = %s", secure($_COOKIE[$this->_cookie_user_id], 'int'))) or _error("SQL_ERROR_THROWEN");
            if ($get_user->num_rows > 0) {
                $this->_data = $get_user->fetch_assoc();
                /* prepare full name */
                /* check unusual login */
                $this->_logged_in = true;
                /* update user language */
            }
        }
    }


    /* ------------------------------- */
    /* User Sign (in|up|out) */
    /* ------------------------------- */

    /**
     * sign_up
     * 
     * @param array $args
     * @return void
     */
    public function sign_up($args = [], $admin)
    {

        global $db, $date;

        if (is_empty($args['firstname']) || is_empty($args['lastname']) || is_empty($args['username']) || is_empty($args['password'])) {
            throw new Exception("Debe completar todos sus datos");
        }

        if (!valid_username($args['username'])) {
            throw new Exception("Username inválido, debe contener mínimo 3 caracteres (a-z0-9_.)");
        }
        if (reserved_username($args['username'])) {
            throw new Exception("No puedes usar este username" . " <strong>" . $args['username'] . "</strong>");
        }
        if ($this->check_username($args['username'])) {
            throw new Exception("Lo siento, ya este username existe");
        }

        if (strlen($args['password']) < 6) {
            throw new Exception("Tu contraseña debe tener mínimo 6 caracteres");
        }

        if (!valid_name($args['firstname'])) {
            throw new Exception("Tu primer nombre contiene caracteres inválidos");
        }

        if (!valid_name($args['lastname'])) {
            throw new Exception("Tu apellido contiene caracteres inválidos");
        }


        /* register user */
        $db->query(sprintf("
            INSERT INTO users (user_name,
                               user_password,
                               user_firstname,
                               user_lastname,
                               user_admin,
                               user_created_at) 
            VALUES (%s, %s, %s, %s, %s, %s)",
                               secure($args['username']),
                               secure(_password_hash($args['password'])),
                               secure(ucwords($args['firstname'])),
                               secure(ucwords($args['lastname'])),
                                secure($args['username']),
                                secure($date))) or _error("SQL_ERROR_THROWEN");

        if($admin){
            $db->query("UPDATE system_option SET option_value =1 WHERE option_name = 'install'");
        }
        
        return true;
    }



    /**
     * _set_authentication_cookies
     * 
     * @param integer $user_id
     * @param boolean $remember
     * @param string $path
     * @return void
     */
    
    private function _set_authentication_cookies($user_id, $remember = false, $path = '/')
    {
        global $db, $date;

        // /* generate new token */
        $session_token = get_hash_token();
        // // /* secured cookies */
        $secured = (get_system_protocol() == "https") ? true : false;
        // // /* set authentication cookies */
        if ($remember) {
            $expire = time() + 2592000;
            setcookie($this->_cookie_user_id, $user_id, $expire, $path, "", $secured, true);
            setcookie($this->_cookie_user_token, $session_token, $expire, $path, "", $secured, true);
        } else {
            setcookie($this->_cookie_user_id, $user_id, 0, $path, "", $secured, true);
            setcookie($this->_cookie_user_token, $session_token, 0, $path, "", $secured, true);
        }
        /* check brute-force attack detection */
        // if ($system['brute_force_detection_enabled']) {
        //     $db->query(sprintf("UPDATE users SET user_failed_login_count = 0 WHERE user_id = %s", secure($user_id, 'int'))) or _error("SQL_ERROR_THROWEN");
        // }
        /* insert user token */
        // $db->query(sprintf("INSERT INTO users_sessions (session_token, session_date, user_id, user_browser, user_os, user_ip) VALUES (%s, %s, %s, %s, %s, %s)", secure($session_token), secure($date), secure($user_id, 'int'), secure(get_user_browser()), secure(get_user_os()), secure(get_user_ip()))) or _error("SQL_ERROR_THROWEN");
    }



    /**
     * sign_in
     * 
     * @param string $username_email
     * @param string $password
     * @param boolean $remember
     * 
     * @return boolean
     */
    public function sign_in($username_email, $password, $remember = false)
    {
        global $db, $system, $date;
        /* valid inputs */
        $username_email = trim($username_email);
        if (is_empty($username_email) || is_empty($password)) {
            throw new Exception("Debes completar todos los datos");
        }
        /* check if username or email */
        if (valid_email($username_email)) {
            $user = $this->check_email($username_email, true);
            if ($user === false) {
                throw new Exception("El correo ingresado no se encuentra registrado");
            }
            $field = "user_email";
        } else {
            if (!valid_username($username_email)) {
                throw new Exception("El username ingresado es inválido");
            }
            $user = $this->check_username($username_email, 'user', true);
            if ($user === false) {
                throw new Exception("El username ingresado no se encuentra registrado");
            }
            $field = "user_name";
        }
        /* check password */
        if (!password_verify($password, $user['user_password'])) {
            throw new Exception("Contraseña incorrecta");
        }
        
        // set_authentication_cookies:
        $this->_set_authentication_cookies($user['user_id']);

    }


    /**
     * sign_out
     * 
     * @return void
     */
    public function sign_out()
    {
        global $db;
        /* destroy the session */
        session_destroy();
        /* unset the cookies */
        unset($_COOKIE[$this->_cookie_user_id]);
        unset($_COOKIE[$this->_cookie_user_token]);
        setcookie($this->_cookie_user_id, NULL, -1, '/');
        setcookie($this->_cookie_user_token, NULL, -1, '/');
    }


    


    /**
     * _check_ip
     * 
     * @return void
     */
    private function _check_ip()
    {
        global $db, $system;
        if ($system['max_accounts'] > 0) {
            $check = $db->query(sprintf("SELECT user_ip, COUNT(*) FROM users_sessions WHERE user_ip = %s GROUP BY user_id", secure(get_user_ip()))) or _error("SQL_ERROR_THROWEN");
            if ($check->num_rows >= $system['max_accounts']) {
                throw new Exception(__("You have reached the maximum number of account for your IP"));
            }
        }
    }



  



    
    /* ------------------------------- */
    /* Password */
    /* ------------------------------- */

    /**
     * forget_password
     * 
     * @param string $email
     * @param string $recaptcha_response
     * @return void
     */
    public function forget_password($email, $recaptcha_response)
    {
        global $db, $system;
        if (!valid_email($email)) {
            throw new Exception(__("Please enter a valid email address"));
        }
        if (!$this->check_email($email)) {
            throw new Exception(__("Sorry, it looks like") . " " . $email . " " . __("doesn't belong to any account"));
        }
        /* check reCAPTCHA */
        if ($system['reCAPTCHA_enabled']) {
            require_once(ABSPATH . 'includes/libs/ReCaptcha/autoload.php');
            $recaptcha = new \ReCaptcha\ReCaptcha($system['reCAPTCHA_secret_key']);
            $resp = $recaptcha->verify($recaptcha_response, get_user_ip());
            if (!$resp->isSuccess()) {
                throw new Exception(__("The security check is incorrect. Please try again"));
            }
        }
        /* generate reset key */
        $reset_key = get_hash_key(6);
        /* update user */
        $db->query(sprintf("UPDATE users SET user_reset_key = %s, user_reseted = '1' WHERE user_email = %s", secure($reset_key), secure($email))) or _error("SQL_ERROR_THROWEN");
        /* send reset email */
        /* prepare reset email */
        $subject = __("Forget password activation key!");
        $body = get_email_template("forget_password_email", $subject, ["email" => $email, "reset_key" => $reset_key]);
        /* send email */
        if (!_email($email, $subject, $body['html'], $body['plain'])) {
            throw new Exception(__("Activation key email could not be sent!"));
        }
    }


    /**
     * forget_password_confirm
     * 
     * @param string $email
     * @param string $reset_key
     * @return void
     */
    public function forget_password_confirm($email, $reset_key)
    {
        global $db;
        if (!valid_email($email)) {
            throw new Exception(__("Invalid email, please try again"));
        }
        /* check reset key */
        $check_key = $db->query(sprintf("SELECT COUNT(*) as count FROM users WHERE user_email = %s AND user_reset_key = %s AND user_reseted = '1'", secure($email), secure($reset_key))) or _error("SQL_ERROR_THROWEN");
        if ($check_key->fetch_assoc()['count'] == 0) {
            throw new Exception(__("Invalid code, please try again"));
        }
    }


    /**
     * forget_password_reset
     * 
     * @param string $email
     * @param string $reset_key
     * @param string $password
     * @param string $confirm
     * @return void
     */
    public function forget_password_reset($email, $reset_key, $password, $confirm)
    {
        global $db;
        if (!valid_email($email)) {
            throw new Exception(__("Invalid email, please try again"));
        }
        /* check reset key */
        $check_key = $db->query(sprintf("SELECT COUNT(*) as count FROM users WHERE user_email = %s AND user_reset_key = %s AND user_reseted = '1'", secure($email), secure($reset_key))) or _error("SQL_ERROR_THROWEN");
        if ($check_key->fetch_assoc()['count'] == 0) {
            throw new Exception(__("Invalid code, please try again"));
        }
        /* check password length */
        if (strlen($password) < 6) {
            throw new Exception(__("Your password must be at least 6 characters long. Please try another"));
        }
        /* check password confirm */
        if ($password !== $confirm) {
            throw new Exception(__("Your passwords do not match. Please try another"));
        }
        /* update user password */
        $db->query(sprintf("UPDATE users SET user_password = %s, user_reseted = '0' WHERE user_email = %s", secure(_password_hash($password)), secure($email))) or _error("SQL_ERROR_THROWEN");
    }


    /* ------------------------------- */
    /* Security Checks */
    /* ------------------------------- */

    /**
     * check_password
     * 
     * @param string $password
     * @return void
     * 
     */
    public function check_password($password)
    {
        /* check if empty */
        if (is_empty($password)) {
            throw new Exception(__("You have to enter your password to continue"));
        }
        /* validate current password */
        if (!password_verify($password, $this->_data['user_password'])) {
            throw new Exception(__("Your current password is incorrect"));
        }
    }

    /**
     * check_email
     * 
     * @param string $email
     * @param boolean $return_info
     * @return boolean|array
     * 
     */
    public function check_email($email, $return_info = false)
    {
        global $db;
        /* check if banned by the system */
        // $email_domain = explode('@', $email)[1];
        // $check_banned = $db->query(sprintf("SELECT COUNT(*) as count FROM blacklist WHERE node_type = 'email' AND node_value = %s", secure(explode('@', $email)[1]))) or _error("SQL_ERROR_THROWEN");
        // if ($check_banned->fetch_assoc()['count'] > 0) {
        //     throw new Exception(__("Sorry but this provider") . " <strong>" . $email_domain . "</strong> " . __("is not allowed in our system"));
        // }
        $query = $db->query(sprintf("SELECT * FROM users WHERE user_email = %s", secure($email))) or _error("SQL_ERROR_THROWEN");
        if ($query->num_rows > 0) {
            if ($return_info) {
                $info = $query->fetch_assoc();
                return $info;
            }
            return true;
        }
        return false;
    }


    /**
     * check_username
     * 
     * @param string $username
     * @param string $type
     * @param boolean $return_info
     * @return boolean|array
     */
    public function check_username($username, $type = 'user', $return_info = false)
    {
        global $db;
        /* check if banned by the system */
        // $check_banned = $db->query(sprintf("SELECT COUNT(*) as count FROM blacklist WHERE node_type = 'username' AND node_value = %s", secure($username))) or _error("SQL_ERROR_THROWEN");
        // if ($check_banned->fetch_assoc()['count'] > 0) {
        //     throw new Exception(__("Sorry but this username") . " <strong>" . $username . "</strong> " . __("is not allowed in our system"));
        // }
        /* check type (user|page|group) */
        switch ($type) {
            case 'page':
                $query = $db->query(sprintf("SELECT * FROM pages WHERE page_name = %s", secure($username))) or _error("SQL_ERROR_THROWEN");
                break;

            case 'group':
                $query = $db->query(sprintf("SELECT * FROM `groups` WHERE group_name = %s", secure($username))) or _error("SQL_ERROR_THROWEN");
                break;

            default:
                $query = $db->query(sprintf("SELECT * FROM users WHERE user_name = %s", secure($username))) or _error("SQL_ERROR_THROWEN");
                break;
        }
        if ($query->num_rows > 0) {
            if ($return_info) {
                $info = $query->fetch_assoc();
                return $info;
            }
            return true;
        }
        return false;
    }



    /********************************
     * 
     * PANEL
     * 
     * ******************************/

    /**
     * 
     * get_config
     * @return array
     * 
     * */

    public function get_config(){
        global $db;
        $config = [];

        $get_config = $db->query("SELECT * FROM system_option");
        if($get_config->num_rows > 0){
            while($row = $get_config->fetch_assoc()){
                $config[$row['option_name']] = $row['option_value'];
            }
        }

        return $config;
    }

    /**
     * 
     * set_config
     * @param array
     * 
     * */

    public function set_config($args = [], $action){
        global $db;

        switch($action){
            case 'wallpaper':
                $db->query(sprintf("UPDATE system_option SET option_value = %s WHERE option_name = 'wallpaper'", secure($args['upload']))) or _error('SQL_ERROR_THROWEN');
                break;

            case 'about':
                $db->query(sprintf("UPDATE system_option SET option_value = %s WHERE option_name = 'about_text'", secure($args['about']))) or _error('SQL_ERROR_THROWEN');
                if($args['upload'] !=""){
                    $db->query(sprintf("UPDATE system_option SET option_value = %s WHERE option_name = 'about_image'", secure($args['upload']))) or _error('SQL_ERROR_THROWEN');
                }
            break;

            default:
                _error('SQL_ERROR_THROWEN');
        }
    }


    /**
     * 
     * get_products
     * @param float
     * 
     * */

    public function get_products($tasa, $where=""){
        global $db;

        $products = [];

        if($where != "")
            $get_products = $db->query("SELECT * FROM products P LEFT JOIN categories C ON P.product_category = C.category_id".$where);
        else
            $get_products = $db->query("SELECT * FROM products P LEFT JOIN categories C ON P.product_category = C.category_id");

        if($get_products->num_rows > 0){
            while($row = $get_products->fetch_assoc()){
                $row['product_price_bs'] = $row['product_price'] * $tasa;
                $row['product_price_sale_bs'] = $row['product_price_sale'] * $tasa;

                $products[] = $row;
            }
        }

        return $products;
    }

    /**
     * 
     * get_product
     * @param int
     * 
     * */

    public function get_product($id){
        global $db;

        $tasa = get_tasa();
        $get_product = $db->query("SELECT * FROM products P LEFT JOIN categories C ON P.product_category = C.category_id WHERE product_id = $id");

        if($get_product->num_rows > 0){
            $product = $get_product->fetch_assoc();
            $product['product_price_bs'] = $product['product_price'] * $tasa;
            $product['product_price_sale_bs'] = $product['product_price_sale'] * $tasa;
        } else
            $product = false;

        return $product;
    }


    /**
     * 
     * register_product
     * @param array
     * 
     * */

    public function register_product($args = []){
        global $db;

        if(is_empty($args['name']) || is_empty($args['marca']) || is_empty($args['price']) || is_empty($args['price_sale']) || is_empty($args['quantity']) || is_empty($args['category']))
            throw new Exception("Debe completar todos los datos obligatorios");

        if(strlen($args['description']) > 500)
            throw new Exception("La descripción no debe exceder los 500 caracteres");

        if(!is_numeric($args['price']))
            throw new Exception("El precio debe ser numérico");

        if(!is_numeric($args['price_sale']))
            throw new Exception("El precio debe ser numérico");

        if(!is_numeric($args['quantity']))
            throw new Exception("La cantidad debe ser numérica");

        if(!valid_category($args['category']))
            throw new Exception("La categoría seleccionada es inválida");

        if($args['price'] <= 0 || $args['price_sale'] <= 0)
            throw new Exception("El precio debe ser mayor a 0");

        if($args['quantity'] <= 0)
            throw new Exception("La cantidad debe ser mayor a 0");

        if($args['price_sale'] < $args['price'])
            throw new Exception("El precio debe de venta no puede ser menor al precio de proveedor");

        $db->query(sprintf("INSERT INTO products (product_name,
                                                    product_marca,
                                                    product_price,
                                                    product_price_sale,
                                                    product_category,
                                                    product_image,
                                                    product_description) VALUES 
                                                    (%s, %s, %s, %s, %s, %s, %s)",
                                                    secure($args['name']),
                                                    secure($args['marca']),
                                                    secure($args['price']),
                                                    secure($args['price_sale']),
                                                    secure($args['category']),
                                                    secure($args['photo']),
                                                    secure($args['description']),)) or _error("SQL_ERROR_THROWEN");
        return true;
    }

    /**
     * 
     * edit_product
     * @param array
     * 
     * */

    public function edit_product($args = [], $id){
        global $db;

        if(is_empty($args['name']) || is_empty($args['marca']) || is_empty($args['price']) || is_empty($args['price_sale']) || is_empty($args['category']))
            throw new Exception("Debe completar todos los datos obligatorios");

        if(strlen($args['description']) > 500)
            throw new Exception("La descripción no debe exceder los 500 caracteres");

        if(!is_numeric($args['price']))
            throw new Exception("El precio debe ser numérico");

        if(!is_numeric($args['price_sale']))
            throw new Exception("El precio debe ser numérico");

        if(!valid_category($args['category']))
            throw new Exception("La categoría seleccionada es inválida");

        if($args['price'] <= 0 || $args['price_sale'] <= 0)
            throw new Exception("El precio debe ser mayor a 0");

        if($args['price_sale'] < $args['price'])
            throw new Exception("El precio debe de venta no puede ser menor al precio de proveedor");

        $db->query(sprintf("UPDATE products SET product_name = %s,
                                                    product_marca = %s,
                                                    product_price = %s,
                                                    product_price_sale = %s,
                                                    product_category = %s,
                                                    product_image = %s,
                                                    product_description = %s WHERE product_id = %s",
                                                    secure($args['name']),
                                                    secure($args['marca']),
                                                    secure($args['price']),
                                                    secure($args['price_sale']),
                                                    secure($args['category']),
                                                    secure($args['photo']),
                                                    secure($args['description']),
                                                    secure($id))) or _error("SQL_ERROR_THROWEN");
        return true;
    }

    /**
     * 
     * upgrade_product
     * @param args
     * 
     * */

    public function upgrade_product($args = []){
        global $db;

        if(is_empty($args['price']) || is_empty($args['price_sale']) || is_empty($args['quantity']))
            throw new Exception("Debe completar todos los datos obligatorios");

        if(!is_numeric($args['price']))
            throw new Exception("El precio debe ser numérico");

        if(!is_numeric($args['price_sale']))
            throw new Exception("El precio debe ser numérico");

        if(!is_numeric($args['quantity']))
            throw new Exception("La cantidad debe ser numérica");

        if($args['price'] <= 0 || $args['price_sale'] <= 0)
            throw new Exception("El precio debe ser mayor a 0");

        if($args['quantity'] <= 0)
            throw new Exception("La cantidad debe ser mayor a 0");

        if($args['price_sale'] < $args['price'])
            throw new Exception("El precio debe de venta no puede ser menor al precio de proveedor");

        $db->query(sprintf("UPDATE products SET product_price = %s, product_price_sale = %s WHERE product_id = %s", 
                            secure($args['price']),
                            secure($args['price_sale']),
                            secure($args['product_id_new']))) or _error("SQL_ERROR_THROWEN");
    }

    /***************************************
     * 
     * PROVIDERS
     * 
     * *************************************/

    /**
     * 
     * get_providers
     * 
     * */

    public function get_providers(){
        global $db;

        $providers = [];
        $get_providers = $db->query("SELECT * FROM providers");

        if($get_providers->num_rows > 0){
            while($row = $get_providers->fetch_assoc()){
                $providers[] = $row; 
            }
        }

        return $providers;
    }

    /**
     * 
     * get_provider
     * @param int
     * 
     * */

    public function get_provider($id){
        global $db;

        $get_provider = $db->query("SELECT * FROM providers WHERE provider_id = $id");

        $provider = $get_provider->fetch_assoc();

        return $provider;
    }

    /**
     * 
     * register_provider
     * @param array
     * 
     * */

    public function register_provider($args = []){
        global $db;

        if(is_empty($args['name']) || is_empty($args['contact']) || is_empty($args['ubication']))
            throw new Exception("Debe completar todos los datos");

        $db->query(sprintf("INSERT INTO providers (provider_name,
                                                    provider_contact,
                                                    provider_ubication) VALUES 
                                                    (%s, %s, %s)",
                                                    secure($args['name']),
                                                    secure($args['contact']),
                                                    secure($args['ubication']),)) or _error("SQL_ERROR_THROWEN");
        return true;
    }

    /**
     * 
     * edit_provider
     * @param array
     * 
     * */

    public function edit_provider($args = [], $id){
        global $db;

        if(is_empty($args['name']) || is_empty($args['contact']) || is_empty($args['ubication']))
            throw new Exception("Debe completar todos los datos");

        $db->query(sprintf("UPDATE providers SET provider_name = %s,
                                                    provider_contact = %s,
                                                    provider_ubication = %s WHERE provider_id = %s",
                                                    secure($args['name']),
                                                    secure($args['contact']),
                                                    secure($args['ubication']),
                                                    secure($id),)) or _error("SQL_ERROR_THROWEN");
        return true;
    }

    /**
     * 
     * delete_provider
     * @param array
     * 
     * */

    public function delete_provider($id){
        global $db;

        $db->query(sprintf("DELETE FROM providers WHERE provider_id = %s",
                                                    secure($id),)) or _error("SQL_ERROR_THROWEN");
        return true;
    }


    /***************************************
     * 
     * CLIENTS
     * 
     * *************************************/

    /**
     * 
     * get_clients
     * 
     * */

    public function get_clients(){
        global $db;

        $clients = [];
        $get_clients = $db->query("SELECT * FROM clients");

        if($get_clients->num_rows > 0){
            while($row = $get_clients->fetch_assoc()){
                $clients[] = $row; 
            }
        }

        return $clients;
    }

    /**
     * 
     * get_client
     * @param int
     * 
     * */

    public function get_client($id){
        global $db;

        $get_client = $db->query("SELECT * FROM clients WHERE client_id = $id") or _error('SQL_ERROR_THROWEN');

        $client = $get_client->fetch_assoc();

        return $client;
    }

    /**
     * 
     * register_client
     * @param array
     * @return array
     * 
     * */

    public function register_client($args = []){
        global $db;

        if(is_empty($args['name']) || is_empty($args['contact']))
            throw new Exception("Debe completar todos los datos del cliente");

        $db->query(sprintf("INSERT INTO clients (client_name,
                                                    client_contact) VALUES 
                                                    (%s, %s)",
                                                    secure($args['name']),
                                                    secure($args['contact']),)) or _error("SQL_ERROR_THROWEN");

        $new = $db->query("SELECT * FROM clients ORDER BY client_id DESC LIMIT 1");
        return $new->fetch_assoc();
    }

    /**
     * 
     * edit_client
     * @param array
     * 
     * */

    public function edit_client($args = [], $id){
        global $db;

        if(is_empty($args['name']) || is_empty($args['contact']))
            throw new Exception("Debe completar todos los datos");

        $db->query(sprintf("UPDATE clients SET client_name = %s,
                                                    client_contact = %s WHERE client_id = %s",
                                                    secure($args['name']),
                                                    secure($args['contact']),
                                                    secure($id))) or _error("SQL_ERROR_THROWEN");
        return true;
    }

    /**
     * 
     * delete_client
     * @param array
     * 
     * */

    public function delete_client($id){
        global $db;

        $db->query(sprintf("DELETE FROM clients WHERE client_id = %s",
                                                    secure($id),)) or _error("SQL_ERROR_THROWEN");
        return true;
    }



    /***************************************
     * 
     * CATEGORIES
     * 
     * *************************************/

    /**
     * 
     * get_categories
     * 
     * */

    public function get_categories(){
        global $db;

        $categories = [];
        $get_categories = $db->query("SELECT * FROM categories");

        if($get_categories->num_rows > 0){
            while($row = $get_categories->fetch_assoc()){
                $categories[] = $row; 
            }
        }

        return $categories;
    }

    /**
     * 
     * get_category
     * 
     * */

    public function get_category($id){
        global $db;

        $get_category = $db->query("SELECT * FROM categories WHERE category_id = $id");

        $category = $get_category->fetch_assoc();        

        return $category;
    }

    /**
     * 
     * register_category
     * @param array
     * 
     * */

    public function register_category($args = []){
        global $db;

        if(is_empty($args['name']))
            throw new Exception("Debe completar todos los datos");

        $db->query(sprintf("INSERT INTO categories (category_name) VALUES 
                                                    (%s)",
                                                    secure($args['name']),)) or _error("SQL_ERROR_THROWEN");
        return true;
    }

    /**
     * 
     * edit_category
     * @param array
     * 
     * */

    public function edit_category($args = [], $id){
        global $db;

        if(is_empty($args['name']))
            throw new Exception("Debe completar todos los datos");

        $db->query(sprintf("UPDATE categories SET category_name = %s WHERE category_id = %s",
                                                    secure($args['name']),
                                                    secure($id),)) or _error("SQL_ERROR_THROWEN");
        return true;
    }

    /**
     * 
     * delete_category
     * @param array
     * 
     * */

    public function delete_category($id){
        global $db;

        $db->query(sprintf("DELETE FROM categories WHERE category_id = %s",
                                                    secure($id),)) or _error("SQL_ERROR_THROWEN");
        return true;
    }

    /***************************************
     * 
     * PURCHASES
     * 
     * *************************************/

    /**
     * 
     * get_purchases
     * 
     * */

     function days_remaining($purchase_date, $days_payment_credit){
        global $date;

        $purchase_date = new DateTime($purchase_date);
        $purchase_date->modify('+'.$days_payment_credit.' day');
        $purchase_date = $purchase_date->format('Y-m-d');

        $date = new DateTime($date);
        $date = $date->format('Y-m-d');

        $datetime1 = date_create($date);
        $datetime2 = date_create($purchase_date);
        $interval = date_diff($datetime1, $datetime2);

        return $interval->format('%R%a días');
    }

    function days_remaining_is_less_5($purchase_date, $days_payment_credit){
        global $date;

        $purchase_date = new DateTime($purchase_date);
        $purchase_date->modify('+'.$days_payment_credit.' day');
        $purchase_date = $purchase_date->format('Y-m-d');

        $date = new DateTime($date);
        $date = $date->format('Y-m-d');

        $datetime1 = date_create($date);
        $datetime2 = date_create($purchase_date);
        $interval = date_diff($datetime1, $datetime2);

        if($interval->format('%R%a') < 5)
            return true;
        else
            return false;
    }

    function Get_Date_Limit($purchase_date, $days_payment_credit){
        $purchase_date = new DateTime($purchase_date);
        $purchase_date->modify('+'.$days_payment_credit.' day');
        $purchase_date = $purchase_date->format('Y-m-d');

        return $purchase_date;
    }

    public function get_purchases($page=null, $type=null){
        global $db, $date;

        $purchases = [];

        if($page==null){
            $get_purchases = $db->query("SELECT * FROM purchases LEFT JOIN providers ON purchases.purchase_provider = providers.provider_id LEFT JOIN users ON purchases.purchase_user = users.user_id");
        } else {
            if($type == 'status')
                $where = "WHERE purchase_status = ".$page;
            else if ($type == 'type') {
                if ($page == 0) {
                    $where = "WHERE purchase_type_payment = 'contado' and purchase_status = 1";
                } else {
                    $where = "WHERE purchase_type_payment = 'credito' and purchase_status = 1";
                }
            }

            $get_purchases = $db->query("SELECT * FROM purchases LEFT JOIN providers ON purchases.purchase_provider = providers.provider_id LEFT JOIN users ON purchases.purchase_user = users.user_id ".$where);
        }
        

        if($get_purchases->num_rows > 0){
            while($row = $get_purchases->fetch_assoc()){
                $purchases[] = $row;
            }
        }

        for ($i=0; $i < count($purchases); $i++) {
            if ($purchases[$i]['purchase_type_payment'] == 'credito') {
                // Obtener dias restantes para pagar a partir de la fecha de compra (purchase_date), los dias de credito (days_payment_credit) y la fecha actual
                $purchases[$i]['days_remaining'] = $this->days_remaining($purchases[$i]['purchase_date'], $purchases[$i]['days_payment_credit']);
                $purchases[$i]['days_remaining_is_less_5'] = $this->days_remaining_is_less_5($purchases[$i]['purchase_date'], $purchases[$i]['days_payment_credit']);
                $purchases[$i]['date_limit'] = $this->Get_Date_Limit($purchases[$i]['purchase_date'], $purchases[$i]['days_payment_credit']);
            } else {
                $purchases[$i]['days_remaining'] = 'N/A';
                $purchases[$i]['days_remaining_is_less_5'] = false;
                $purchases[$i]['date_limit'] = 'N/A';
            }
        }

        return $purchases;
    }

    /**
     * 
     * new_purchase
     * 
     * */

    public function new_purchase(){
        global $db;

        $db->query(sprintf("INSERT INTO purchases (purchase_user) VALUES (%s)", secure($_COOKIE[$this->_cookie_user_id], 'int'))) or _error("SQL_ERROR_THROWEN");

        $new = $db->query("SELECT * FROM purchases ORDER BY purchase_id DESC LIMIT 1");
        $purchase = $new->fetch_assoc();

        return $purchase;
    }

    /**
     * 
     * get_purchase
     * @param int
     * @return array
     * 
     * */

    public function get_purchase($id){
        global $db;

        $get_purchase = $db->query(sprintf("SELECT * FROM purchases LEFT JOIN providers ON purchases.purchase_provider = providers.provider_id WHERE purchase_id = %s", secure($id))) or _error("SQL_ERROR_THROWEN");

        $purchase = $get_purchase->fetch_assoc();

        if ($purchase['purchase_type_payment'] == 'credito' && $purchase['purchase_status'] == 1) {
            // Obtener dias restantes para pagar a partir de la fecha de compra (purchase_date), los dias de credito (days_payment_credit) y la fecha actual
            $purchase['days_remaining'] = $this->days_remaining($purchase['purchase_date'], $purchase['days_payment_credit']);
            $purchase['days_remaining_is_less_5'] = $this->days_remaining_is_less_5($purchase['purchase_date'], $purchase['days_payment_credit']);
            $purchase['date_limit'] = $this->Get_Date_Limit($purchase['purchase_date'], $purchase['days_payment_credit']);
        } else {
            $purchase['days_remaining'] = 'N/A';
            $purchase['days_remaining_is_less_5'] = false;
            $purchase['date_limit'] = 'N/A';
        }

        return $purchase;
    }

    /**
     * 
     * add_purchase
     * @param array
     * @param int
     * @param boolean
     * @return array
     * 
     * */

    public function add_purchase($args = [], $purchase, $exist){
        global $db;

        if($exist){
            $id = ($db->query("SELECT product_id FROM products ORDER BY product_id DESC LIMIT 1"))->fetch_assoc();
            $args['product_id_new'] = $id['product_id'];
        }

        $tasa = get_tasa();

        $price_bs = $args['price'] * $tasa;

        $subtotal = ($args['price'] * $args['quantity']);

        $db->query(sprintf("INSERT INTO purchase_detail (detail_product, detail_price_unit, detail_price_unit_bs, detail_quantity, detail_sub_total, purchase_id) VALUES (%s, %s, %s, %s, %s, %s)", 
            secure($args['product_id_new']),
            secure($args['price']),
            secure($price_bs),
            secure($args['quantity']),
            secure($subtotal),
            secure($purchase))) or _error("SQL_ERROR_THROWEN");

        $new = $db->query("SELECT * FROM purchase_detail LEFT JOIN products ON purchase_detail.detail_product = products.product_id ORDER BY purchase_detail_id DESC LIMIT 1");
        $detail = $new->fetch_assoc();

        return $detail;
    }

    /**
     * 
     * desc_purchase
     * 
     * */

    public function desc_purchase($id){
        global $db;

        $db->query("DELETE FROM purchase_detail WHERE purchase_detail_id = $id");
    }

    /**
     * 
     * get_details_purchase
     * @param int
     * @return array
     * 
     * */

    public function get_details_purchase($id){
        global $db;

        $details = [];

        $get_details = $db->query(sprintf("SELECT * FROM purchase_detail PD LEFT JOIN products P ON PD.detail_product = P.product_id WHERE purchase_id = %s", secure($id))) or _error("SQL_ERROR_THROWEN");

        if($get_details->num_rows>0){
            while($row = $get_details->fetch_assoc()){
                $details[] = $row;
            }
        }

        return $details;
    }

    /**
     * 
     * get_sum_details_purchase
     * @param int
     * @return float
     * 
     * */

    public function get_sum_details_purchase($id){
        global $db;


        $get_details = $db->query(sprintf("SELECT SUM(detail_sub_total) AS balance FROM purchase_detail WHERE purchase_id = %s", secure($id))) or _error("SQL_ERROR_THROWEN");

        $sum = $get_details->fetch_assoc();

        return $sum;
    }

    /**
     * 
     * check_purchase
     * @param array
     * @param int
     * 
     * */

    public function check_purchase($args = [], $id){
        global $db, $date;

        if(is_empty($args['provider']) || is_empty($args['date']))
            throw new Exception("Debe completar todos los datos obligatorios (*)");

        if ($args['purchase_type_payment'] != 'contado' && $args['purchase_type_payment'] != 'credito')
            throw new Exception("Tipo de pago inválido");

        if ($args['purchase_type_payment'] == 'credito')
            if (is_empty($args['days_payment_credit']))
                throw new Exception("Debe completar los días de crédito");
            else if (!is_numeric($args['days_payment_credit']))
                throw new Exception("Los días de crédito deben ser numéricos");
            else if ($args['days_payment_credit'] < 1)
                throw new Exception("Los días de crédito deben ser mayor a 0");

        if(!$this->get_provider($args['provider']))
            throw new Exception("Proveedor inválido");

        if($args['date'] > $date)
            throw new Exception("Fecha inválida");

        $get_balance = $db->query(sprintf("SELECT SUM(detail_sub_total) AS balance FROM purchase_detail WHERE purchase_id = %s", secure($id))) or _error("SQL_ERROR_THROWEN");

        $balance = $get_balance->fetch_assoc();

        $balance_bs = $balance['balance'] * get_tasa();

        $details = $this->get_details_purchase($id);
        foreach ($details as $value) {
            $value['product_quantity'] = $this->get_product($value['product_id'])['product_quantity'];
            $res = $value['product_quantity'] + $value['detail_quantity'];
            $db->query(sprintf("UPDATE products SET product_quantity = %s WHERE product_id = %s",
                        secure($res),
                        secure($value['product_id']))) or _error("SQL_ERROR_THROWEN");
        }

        $db->query(sprintf("UPDATE purchases SET purchase_provider = %s, purchase_date = %s, purchase_invoice = %s, 
                            purchase_method = %s, purchase_amount = %s, purchase_amount_bs = %s, purchase_status =%s, 
                            purchase_type_payment = %s, days_payment_credit = %s
                            WHERE purchase_id = %s", 
            secure($args['provider']),
            secure($args['date']),
            secure($args['invoice']),
            secure($args['method']),
            secure($balance['balance']),
            secure($balance_bs),
            secure(true),
            secure($args['purchase_type_payment']),
            // Si es contado se le asigna 0 días de crédito
            secure($args['purchase_type_payment'] == 'contado' ? 0 : $args['days_payment_credit']),
            secure($id))) or _error("SQL_ERROR_THROWEN");
    }

    /**
     * 
     * delete_purchase
     * 
     * */

    public function delete_purchase($id){
        global $db;

        $purchase = $this->get_purchase($id);

        if(!$purchase)
            throw new Exception('Venta inválida');

        if($purchase['purchase_status'])
            throw new Exception('Esta compra ya fue concretada, no puede eliminarse');

        $db->query("DELETE FROM purchases WHERE purchase_id = $id") or _error('SQL_ERROR_THROWEN');
    }

    /**
     * 
     * Check Credit Payment Purchase
     * 
     * */

    public function check_credit_payment_purchase($id){
        global $db, $date;
        
        $purchase = $this->get_purchase($id);

        if(!$purchase)
            throw new Exception('Compra inválida');

        if($purchase['purchase_type_payment'] != 'credito')
            throw new Exception('Esta compra no es a crédito');

        if ($purchase['credit_payment'])
            throw new Exception('Esta compra ya fue pagada');

        $db->query(sprintf("
            UPDATE purchases SET credit_payment = %s WHERE purchase_id = %s",
            secure(true),
            secure($id))) or _error('SQL_ERROR_THROWEN');
    }

    /***************************************
     * 
     * SALES
     * 
     * *************************************/

    /**
     * 
     * get_sales
     * 
     * */

    public function get_sales($page=null, $type=null){
        global $db, $date;

        $sales = [];

        if($page==null){
            $get_sales = $db->query("SELECT * FROM sales LEFT JOIN clients ON sales.sale_client = clients.client_id LEFT JOIN users ON sales.sale_user = users.user_id");
        } else {
            if($type == 'status')
                $where = "WHERE sale_status = ".$page;
            else if ($type == 'type') {
                if ($page == 0) {
                    $where = "WHERE sale_type_payment = 'contado' and sale_status = 1";
                } else {
                    $where = "WHERE sale_type_payment = 'credito' and sale_status = 1";
                }
            }

            $get_sales = $db->query("SELECT * FROM sales LEFT JOIN clients ON sales.sale_client = clients.client_id LEFT JOIN users ON sales.sale_user = users.user_id ".$where);
        }
        

        if($get_sales->num_rows > 0){
            while($row = $get_sales->fetch_assoc()){
                $sales[] = $row;
            }
        }

        for ($i=0; $i < count($sales); $i++) {
            if ($sales[$i]['sale_type_payment'] == 'credito') {
                // Obtener dias restantes para pagar a partir de la fecha de compra (sale_date), los dias de credito (days_payment_credit) y la fecha actual
                $sales[$i]['days_remaining'] = $this->days_remaining($sales[$i]['sale_date'], $sales[$i]['days_payment_credit']);
                $sales[$i]['days_remaining_is_less_5'] = $this->days_remaining_is_less_5($sales[$i]['sale_date'], $sales[$i]['days_payment_credit']);
                $sales[$i]['date_limit'] = $this->Get_Date_Limit($sales[$i]['sale_date'], $sales[$i]['days_payment_credit']);
            } else {
                $sales[$i]['days_remaining'] = 'N/A';
                $sales[$i]['days_remaining_is_less_5'] = false;
                $sales[$i]['date_limit'] = 'N/A';
            }
        }        

        return $sales;
    }

    /**
     * 
     * new_sale
     * 
     * */

    public function new_sale(){
        global $db;

        $db->query(sprintf("INSERT INTO sales (sale_user) VALUES (%s)", secure($_COOKIE[$this->_cookie_user_id], 'int'))) or _error("SQL_ERROR_THROWEN");

        $new = $db->query("SELECT * FROM sales ORDER BY sale_id DESC LIMIT 1");
        $sale = $new->fetch_assoc();

        return $sale;
    }

    /**
     * 
     * get_sale
     * @param int
     * @return array
     * 
     * */

    public function get_sale($id){
        global $db;

        $get_sale = $db->query(sprintf("SELECT * FROM sales LEFT JOIN clients ON sales.sale_client = clients.client_id WHERE sale_id = %s", secure($id))) or _error("SQL_ERROR_THROWEN");

        $sale = $get_sale->fetch_assoc();

        if ($sale['sale_type_payment'] == 'credito' && $sale['sale_status'] == 1) {
            // Obtener dias restantes para pagar a partir de la fecha de compra (sale_date), los dias de credito (days_payment_credit) y la fecha actual
            $sale['days_remaining'] = $this->days_remaining($sale['sale_date'], $sale['days_payment_credit']);
            $sale['days_remaining_is_less_5'] = $this->days_remaining_is_less_5($sale['sale_date'], $sale['days_payment_credit']);
            $sale['date_limit'] = $this->Get_Date_Limit($sale['sale_date'], $sale['days_payment_credit']);
        } else {
            $sale['days_remaining'] = 'N/A';
            $sale['days_remaining_is_less_5'] = false;
            $sale['date_limit'] = 'N/A';
        }

        return $sale;
    }

    /**
     * 
     * add_sale
     * @param array
     * @param int
     * @param boolean
     * @return array
     * 
     * */

    public function add_sale($args = [], $sale, $exist){
        global $db;

        if(!is_numeric($args['quantity']) || $args['quantity'] <= 0)
            throw new Exception('La cantidad ingresada es inválida');

        $product = $this->get_product($args['product_id']);

        if(!$product)
            throw new Exception('Este producto no existe en su stock');

        $check_stock = check_stock($args['quantity'], $args['product_id']);
        if(!$check_stock[0])
            throw new Exception('El stock de este producto es inferior a la cantidad solicitada, sólo quedan '.$check_stock[1].' unidades');

        $tasa = get_tasa();

        $subtotal = ($product['product_price_sale'] * $args['quantity']);

        $price_bs = ($product['product_price_sale'] * $tasa);

        $db->query(sprintf("INSERT INTO sale_detail (detail_product, detail_price_unit, detail_price_unit_bs, detail_quantity, detail_sub_total, sale_id) VALUES (%s, %s, %s, %s, %s, %s)", 
            secure($args['product_id']),
            secure($product['product_price_sale']),
            secure($price_bs),
            secure($args['quantity']),
            secure($subtotal),
            secure($sale))) or _error("SQL_ERROR_THROWEN");

        $new = $db->query("SELECT * FROM sale_detail LEFT JOIN products ON sale_detail.detail_product = products.product_id ORDER BY sale_detail_id DESC LIMIT 1");
        $detail = $new->fetch_assoc();

        return $detail;
    }

    /**
     * 
     * desc_sale
     * 
     * */

    public function desc_sale($id){
        global $db;

        $db->query("DELETE FROM sale_detail WHERE sale_detail_id = $id");
    }

    /**
     * 
     * get_details_sale
     * @param int
     * @return array
     * 
     * */

    public function get_details_sale($id){
        global $db;

        $details = [];

        $get_details = $db->query(sprintf("SELECT * FROM sale_detail PD LEFT JOIN products P ON PD.detail_product = P.product_id WHERE sale_id = %s", secure($id))) or _error("SQL_ERROR_THROWEN");

        if($get_details->num_rows>0){
            while($row = $get_details->fetch_assoc()){
                $details[] = $row;
            }
        }

        return $details;
    }

    /**
     * 
     * get_sum_details_sale
     * @param int
     * @return float
     * 
     * */

    public function get_sum_details_sale($id){
        global $db;


        $get_details = $db->query(sprintf("SELECT SUM(detail_sub_total) AS balance FROM sale_detail WHERE sale_id = %s", secure($id))) or _error("SQL_ERROR_THROWEN");

        $sum = $get_details->fetch_assoc();

        return $sum;
    }

    /**
     * 
     * check_sale
     * @param array
     * @param int
     * 
     * */

    public function check_sale($args = [], $id){
        global $db, $date;

        if(is_empty($args['hd_client_id']))
            throw new Exception("Debe completar todos los datos obligatorios (*)");

        if($args['hd_client_type'] == 'new'){
            $arr = array('name' => $args['hd_client_name'], 'contact' => $args['hd_client_contact']);
            $new_client = $this->register_client($arr);
            $args['hd_client_id'] = $new_client['client_id'];
        } else{
            if(!$this->get_client($args['hd_client_id']))
                throw new Exception("Cliente no encontrado");
        }

        if ($args['sale_type_payment'] != 'contado' && $args['sale_type_payment'] != 'credito')
            throw new Exception("Tipo de pago inválido");

        if ($args['sale_type_payment'] == 'credito')
            if (is_empty($args['days_payment_credit']))
                throw new Exception("Debe completar los días de crédito");
            else if (!is_numeric($args['days_payment_credit']))
                throw new Exception("Los días de crédito deben ser numéricos");
            else if ($args['days_payment_credit'] < 1)
                throw new Exception("Los días de crédito deben ser mayor a 0");

        $get_balance = $db->query(sprintf("SELECT SUM(detail_sub_total) AS balance FROM sale_detail WHERE sale_id = %s", secure($id))) or _error("SQL_ERROR_THROWEN");

        $balance = $get_balance->fetch_assoc();

        $balance_bs = $balance['balance'] * get_tasa();

        $details = $this->get_details_sale($id);
        foreach ($details as $value) {
            $value['product_quantity'] = $this->get_product($value['product_id'])['product_quantity'];
            $res = $value['product_quantity'] - $value['detail_quantity'];
            if($res <0)
                $res = 0;
            $db->query(sprintf("UPDATE products SET product_quantity = %s WHERE product_id = %s",
                        secure($res),
                        secure($value['product_id']))) or _error("SQL_ERROR_THROWEN");
        }

        $db->query(sprintf("UPDATE sales SET sale_client = %s, sale_date = %s, 
                            sale_amount = %s, sale_amount_bs = %s, 
                            sale_status =%s, sale_type_payment = %s, days_payment_credit = %s
                            WHERE sale_id = %s", 
            secure($args['hd_client_id']),
            secure($date),
            secure($balance['balance']),
            secure($balance_bs),
            secure(true),
            secure($args['sale_type_payment']),
            // Si es contado se le asigna 0 días de crédito
            secure($args['sale_type_payment'] == 'contado' ? 0 : $args['days_payment_credit']),
            secure($id))) or _error("SQL_ERROR_THROWEN");
    }

    /**
     * 
     * delete_sale
     * 
     * */

    public function delete_sale($id){
        global $db;

        $sale = $this->get_sale($id);

        if(!$sale)
            throw new Exception('Venta inválida');

        if($sale['sale_status'])
            throw new Exception('Esta venta ya fue concretada, no puede eliminarse');

        $db->query("DELETE FROM sales WHERE sale_id = $id") or _error('SQL_ERROR_THROWEN');
    }

    /**
     * 
     * Check Credit Payment Sale
     * 
     * */

    public function check_credit_payment_sale($id){
        global $db, $date;
        
        $sale = $this->get_sale($id);

        if(!$sale)
            throw new Exception('Venta inválida');

        if($sale['sale_type_payment'] != 'credito')
            throw new Exception('Esta venta no es a crédito');

        if ($sale['credit_payment'])
            throw new Exception('Esta venta ya fue pagada');

        $db->query(sprintf("
            UPDATE sales SET credit_payment = %s WHERE sale_id = %s",
            secure(true),
            secure($id))) or _error('SQL_ERROR_THROWEN');
    }
}

class PrivacyException extends Exception
{
}
