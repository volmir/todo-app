<?php

namespace App\Models;

class Auth {
    
    /**
     * 
     * @param array $data
     * @return boolean
     */
    public function login($data) {        
        if ($data['login'] == 'admin' && $data['password'] == '123') {
            $_SESSION['auth'] = true;
            
            return true;
        }
        
        return false;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isAuth() {   
        if (isset($_SESSION['auth'])) {          
            return true;
        } else {        
            return false;
        }
    }    
    
    /**
     * 
     * @param array $data
     * @return array
     */
    public function check($data) {
        $errors = [];
        
        if (empty($data['login'])) {
            $errors[] = 'Не введен логин пользователя';
        }
        if (empty($data['password'])) {
            $errors[] = 'Не введен пароль пользователя';
        }  
        
        return $errors;
    }    

    public function logout() {
        if (isset($_SESSION['auth'])) {
            unset($_SESSION['auth']);
        }
    }     
    
}
