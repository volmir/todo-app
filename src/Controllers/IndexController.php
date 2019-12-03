<?php

namespace App\Controllers;

use App\Core\Controller;
use RedBeanPHP\R as RedBean;
use App\Utility\Pagination;
use App\Models\Todo;
use App\Core\Response;

class IndexController extends Controller
{

    public function indexAction() 
    {
        $items_in_page = 3;
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
        
        $sql = "SELECT count(id) as count_rows FROM todo";
        $todos_count = RedBean::getCol($sql);
        
        $sql = "SELECT * "
                . "FROM todo "
                . "ORDER BY id DESC "
                . "LIMIT " . ($page - 1) * $items_in_page . ", " . $items_in_page;
        $todos = RedBean::getAll($sql);
               
        $pagination = new Pagination();
        $pages = $pagination->setCurrentPage($page)
                ->setRecordsCount($todos_count[0])
                ->setPerPageLimit($items_in_page)
                ->setMaxPageCount(6)
                ->getPages();         
        
        $this->view->set([
            'title' => 'ToDo',
            'todos' => $todos,            
            'pages' => $pages,            
        ]);

        $this->view->render('index');
    }
    
    public function addAction() 
    {         
        $todoModel = new Todo();
        $errors = [];
        
        $data = $_REQUEST;        
        $id = (!empty($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0);
             
        if (isset($_REQUEST['submit']) && empty($errors = $todoModel->check($data))) {      
            if ($id) {
                if ($todoModel->save($data)) {
                    $_SESSION['message'] = 'Задание успешно сохранено';
                }
            } else {
                if ($todoModel->add($data)) {
                    $_SESSION['message'] = 'Задание успешно добавлено';                    
                } 
            } 
            Response::redirect('/');
        }
        
        if ($id) {
            $data = RedBean::getRow('SELECT * FROM `todo` WHERE `id` = :id LIMIT 1', ['id' => $id]);
        }        
                
        $this->view->set([
            'title' => 'Add/Edit new ToDo',  
            'errors' => $errors,
            'data' => $data,
            'id' => $id,
        ]);

        $this->view->render('add');
    }    

}
