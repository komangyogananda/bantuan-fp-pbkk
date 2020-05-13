<?php

$loader = new \Phalcon\Loader();
/**
 * We're a registering a set of directories taken from the configuration file
 */
include __DIR__.'/../../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createMutable(__DIR__.'/../../');
$dotenv->load();

$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->managersDir
    ]
)->register();
