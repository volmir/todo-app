<?php

namespace App\Controllers;

use App\Core\Controller;

class SiteController extends Controller 
{
    
    public function error404Action() 
    {        
        $this->view->set([
            'title' => '404: Page not found',
        ]);
        $this->view->render('error404');
    }   
    
    public function robotsAction() 
    {        
        $this->view->set([
            'request_scheme' => $_SERVER['REQUEST_SCHEME'],
            'server_name' => $_SERVER['SERVER_NAME'],
        ]);
        $this->view->renderPartial('robots.txt');
    }   
    
    public function sitemapAction() 
    {        
        $this->view->set([
            'request_scheme' => $_SERVER['REQUEST_SCHEME'],
            'server_name' => $_SERVER['SERVER_NAME'],
            'date' => date('Y-m-d'),
        ]);
        $this->view->renderPartial('sitemap.xml');
    }      
    
}
