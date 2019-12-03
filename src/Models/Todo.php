<?php

namespace App\Models;

use RedBeanPHP\R as RedBean;
use App\Models\Auth;

class Todo {
    
    const EDIT_ADMIN = 1;
    
    /**
     *
     * @var array 
     */
    private $statuses = [
        0 => 'Новое',
        1 => 'Выполнено',
        2 => 'Закрыто',
    ];
    
    /**
     * 
     * @param int $status
     * @return string
     */
    public function getStatusName(int $status_id) {
        $status = $this->statuses[0];
        
        if (!empty($this->statuses[$status_id])) {
            $status = $this->statuses[$status_id];
        }
        
        return $status;
    }
    
    /**
     * 
     * @return array
     */
    public function getStatuses() {
        return $this->statuses;
    }
    
    /**
     * 
     * @param array $data
     * @return boolean
     */
    public function add($data) {
        $todo = RedBean::dispense('todo');
        $todo->username = $data['username'];
        $todo->email = $data['email'];       
        $todo->description = strip_tags($data['description']);  
        $todo->status = $data['status'];       
        RedBean::store($todo);
        
        return true;
    }
    
    /**
     * 
     * @param array $data
     * @return boolean
     */
    public function save($data) {
        $todo = RedBean::load('todo', $data['id']);
        
        $auth = new Auth();
        if ($auth->isAuth() && trim($todo->description) != trim($data['description'])) {
            $todo->edit_admin = self::EDIT_ADMIN; 
        }        
        
        $todo->username = $data['username'];
        $todo->email = $data['email'];       
        $todo->description = strip_tags($data['description']);  
        $todo->status = $data['status'];  
      
        RedBean::store($todo);
        
        return true;
    }    
    
    /**
     * 
     * @param array $data
     * @return array
     */
    public function check($data) {
        $errors = [];
        
        if (empty($data['username'])) {
            $errors[] = 'Не введено имя пользователя';
        }
        if (empty($data['email'])) {
            $errors[] = 'Не введен email пользователя';
        }  
        if (empty($data['description'])) {
            $errors[] = 'Не введено описание';
        } 
        if (!isset($data['status'])) {
            $errors[] = 'Не указан статус';
        } 
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'E-mail адрес указан неверно';
        } 
        
        return $errors;
    }    

}
