<?php

namespace App\Core;

use App\Core\View;
use App\Core\Application;

abstract class Controller
{
    /** 
     * 
     * @var Application 
     */
    public $application;
    /**
     *
     * @var View 
     */
    public $view;
    
    public function __construct() 
    {
        
    }    

    /**
     * 
     * @param Application $application
     * @return $this
     */
    public function setApplication(Application $application)
    {
        $this->application = $application;  
        
        $controllerPath = explode('\\', get_called_class());
        $controllerName = strtolower(array_pop($controllerPath));
        $this->view = new View($this);
        $this->view->setPath(dirname(__DIR__) . '/../templates/' . $controllerName . '/');        
       
        return $this;
    }    
    
    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function __get($name) 
    {
        if (property_exists($this->application, $name)) {
            return $this->application->$name;
        }        
    }

    public function run()
    {
        $action = $this->router->getActionName();
        try {
            if (method_exists($this, $action)) {
                ob_start();
                call_user_func_array(array($this, $action), $this->router->getActionParams());
                $output = ob_get_contents();
                ob_end_clean();
                
                $this->response->setContent($output);
            } else {
                throw new \Exception('Action "' . $action . '" not exists: ' . $_SERVER["REQUEST_URI"]);                
            }
        } catch (\Exception $e) {
            $this->response->setHeader("HTTP/1.1 404 Not Found");
            $this->router->error404();
            $this->application->execute();
            exit();
        }       
    }    
}
