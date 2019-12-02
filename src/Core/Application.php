<?php

namespace App\Core;

use App\Core\Registry;
use App\Core\Benchmark;
use App\Core\Response;
use App\Core\Router;
use App\Adapter\DoctrineAdapter;
use Doctrine\ORM\EntityManager;

class Application
{
    /**
     *
     * @var Benchmark
     */
    public $benchmark;
    /**
     *
     * @var Registry
     */
    public $config;
    /**
     *
     * @var EntityManager
     */
    public $em;    

    /**
     *
     * @param array $config
     */
    public function run($config = [])
    {
        $this->benchmark = new Benchmark();        
        $this->config = new Registry($config);      
        $this->response = new Response();
        $this->router = new Router($this->config->routes);        
        $this->em = (new DoctrineAdapter($this->config->db))->getEm();        
        $this->execute();
    }

    public function execute()
    {
        $controllerName = $this->router->getControllerName();
        try {
            $controllerClass = '\\App\Controllers\\' . $controllerName;
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass;
                if ($controller instanceof Controller) {
                    $controller->setApplication($this)->run();
                }
            } else {
                throw new \Exception('Controller "' . $controllerName . '" not exists: ' . $_SERVER["REQUEST_URI"]);
            }
        } catch (\Exception $e) {
            $this->response->setHeader("HTTP/1.1 404 Not Found");
            $this->router->error404();
            $this->execute();
            exit();
        }

        $this->response->sendHeaders();

        echo $this->response->getContent();
    }

    public function db($em)
    {
        $this->em = $em;
    }    
    
}
