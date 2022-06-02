<?php
class Session {
    /*
     * data(key, value) => set session
     * data(key) => get session
     *
     * */

    static public function data($key='', $value=''){
        $sessionKey = self::isInvalid();
        if (!empty($value)){
            if (!empty($key)){
                $_SESSION[$sessionKey][$key] = $value;
                return true;
            }
        } else {
            if (empty($key)){
                if (isset($_SESSION[$sessionKey])){
                    return $_SESSION[$sessionKey];
                }
            } else {
                if (isset($_SESSION[$sessionKey][$key])){
                    return $_SESSION[$sessionKey][$key];
                }
            }
        }
        return false;
    }

    /*
     * delete(key) => clear key session
     * delete() => clear all session
     * */
    static public function delete($key=''){
        $sessionKey = self::isInvalid();
        if (!empty($key)){
            if (isset($_SESSION[$sessionKey][$key])){
                unset($_SESSION[$sessionKey][$key]);
                return true;
            }
            return false;
        } else {
            unset($_SESSION[$sessionKey]);
            return true;
        }
        return false;
    }

    /*
     * Flash data
     * - set flash data same set session
     * - get flash data same set session but when delete session before get session
     * */

    static public function flash($key='', $value=''){
        $dataFlash = self::data($key, $value);
        if (empty($value)){
            self::delete($key);
        }
        return $dataFlash;
    }

    static public function showErrors($msg){
        $data = ['msg' => $msg];
        App::$app->loadError('exception', $data);
        die();
    }

    static function isInvalid(){
        global $config;
        if (!empty($config['session'])){
            $sessionConfig = $config['session'];
            if (!empty($sessionConfig['session_key'])){
                $sessionKey = $sessionConfig['session_key'];
                return $sessionKey;
            } else {
                self::showErrors('Thiếu cấu hình session_key vui lòng kiểm tra file configs/session.php');
            }
        } else {
            self::showErrors('Thiếu cấu hình Session vui lòng kiểm tra file configs/session.php');
        }
        return false;
    }
}