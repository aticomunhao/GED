<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// Constantes do CodeIgniter
define('APPPATH', dirname(__FILE__) . '/application/');
define('BASEPATH', APPPATH . '/../system/');
define('ENVIRONMENT', 'development');

// Inclusão da classe do Doctrine
chdir(APPPATH);
require APPPATH . '/libraries/Doctrine.php';

$doctrine = new Doctrine();
$entityManager = $doctrine->em;

return ConsoleRunner::createHelperSet($entityManager);