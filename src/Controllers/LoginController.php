<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Auth;
use App\Core\Response;

class LoginController extends Controller
{

    public function indexAction() 
    {
        $auth = new Auth();
        $errors = [];
        
        if (isset($_REQUEST['submit']) && empty($errors = $auth->check($_REQUEST))) {            
            if ($auth->login($_REQUEST)) {
                $_SESSION['message'] = 'Вход осуществлен';
                Response::redirect('/');
            } else {
                $errors[] = 'Неверный логин/пароль';
            } 
        }
                
        $this->view->set([
            'title' => 'Вход (для администратора)',  
            'errors' => $errors,
        ]);

        $this->view->render('index');
    }    

    public function logoutAction() 
    {
        $auth = new Auth();
        $auth->logout();
        Response::redirect('/');
    }    
    
}
