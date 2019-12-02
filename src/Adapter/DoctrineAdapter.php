<?php

namespace App\Adapter;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DoctrineAdapter 
{
    /**
     *
     * @var EntityManager
     */
    private $em;
    
    public function __construct($dbParams) 
    {
        $isDevMode = true;
        $entitiesPaths = array(__DIR__.'/../Entity');

        $config = Setup::createAnnotationMetadataConfiguration($entitiesPaths, $isDevMode);
        $this->em = \Doctrine\ORM\EntityManager::create($dbParams, $config);
    }   
    
    /**
     * 
     * @return EntityManager
     */
    public function getEm(): EntityManager {
        return $this->em;
    }


}
