<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Debug;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $debug = new Debug();
    $debug->listen();
    $di = new FactoryDefault();
    include __DIR__.'/../vendor/autoload.php';
    $dotenv = \Dotenv\Dotenv::createMutable(__DIR__.'/../');
    $dotenv->load();

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    $application->handle($_SERVER['REQUEST_URI'])->send();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
