<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Entity\Todo;

class Index extends Controller
{

    public function indexAction() 
    {
       
        $this->view->set([
            'title' => 'ToDo',
        ]);

        $this->view->render('index');
    }

}
