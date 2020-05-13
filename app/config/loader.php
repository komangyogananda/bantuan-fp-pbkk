<?php

$loader = new \Phalcon\Loader();
include __DIR__.'/../../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createMutable(__DIR__.'/../../');
$dotenv->load();
/**
 * We're a registering a set of directories taken from the configuration file
 */

$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();
