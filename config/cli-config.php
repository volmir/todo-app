<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use App\Adapter\DoctrineAdapter;

$config = require('config.php');

require(__DIR__ . '/../src/Adapter/DoctrineAdapter.php');

$entityManager = (new DoctrineAdapter($config['db']))->getEm();

return ConsoleRunner::createHelperSet($entityManager);

