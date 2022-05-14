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
    public function sign_up($args = [])
    {
        global $db, $date;
        /* check invitation code */
        // if ($system['invitation_enabled']) {
        //     if (!$this->check_invitation_code($args['invitation_code'])) {
        //         throw new Exception(__("The invitation code is invalid or expired"));
        //     }
        // }
        //identifi
        /* check IP */
        // $this->_check_ip();
        if (is_empty($args['first_name']) || is_empty($args['last_name']) || is_empty($args['username']) || is_empty($args['password']) || is_empty($args['email'])) {
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
        if (!valid_email($args['email'])) {
            throw new Exception("Por favor ingrese un correo válido");
        }

        if ($this->check_email($args['email'])) {
            throw new Exception("Lo siento este correo ya esta siendo usado");
        }
        /*
        if ($system['activation_enabled'] && $system['activation_type'] == "sms") {
            if (is_empty($args['phone'])) {
                throw new Exception("Please enter a valid phone number");
            }
            $args['phone'] = $args['phone_code'] . $args['phone'];
            if ($this->check_phone($args['phone'])) {
                throw new Exception("Sorry, it looks like") . " <strong>" . $args['phone'] . "</strong> " . "belongs to an existing account");
            }
        } else {
            $args['phone'] = 'null';
        }
        */
        if (strlen($args['password']) < 6) {
            throw new Exception("Tu contraseña debe tener mínimo 6 caracteres");
        }

        if (!valid_name($args['first_name'])) {
            throw new Exception("Tu primer nombre contiene caracteres inválidos");
        }

        if (!valid_name($args['last_name'])) {
            throw new Exception("Tu apellido contiene caracteres inválidos");
        }


        /* register user */
        $db->query(sprintf("
            INSERT INTO users (user_name,
                               user_email,
                               user_password,
                               user_firstname,
                               user_lastname) 
            VALUES (%s, %s, %s, %s, %s)",
                               secure($args['username']),
                               secure($args['email']),
                               secure(_password_hash($args['password'])),
                               secure(ucwords($args['first_name'])),
                               secure(ucwords($args['last_name'])))) or _error("SQL_ERROR_THROWEN");
        
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
            throw new Exception("<p><strong>" . "Contraseña incorrecta" . "</strong></p>");
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
}

class PrivacyException extends Exception
{
}
