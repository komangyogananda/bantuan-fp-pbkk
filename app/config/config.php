<?php

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

if (! http_response_code() || defined('STDIN')) {
//  quick hack phalcon devtools cannot read .env file
  require __DIR__."/../../vendor/autoload.php";
  $dotenv = \Dotenv\Dotenv::createMutable(__DIR__.'/../../');
  $dotenv->load();
}

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => getenv("DB_HOST"),
        'username'    => getenv("DB_USERNAME"),
        'password'    => getenv("DB_PASSWORD"),
        'dbname'      => getenv("DB_NAME"),
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'managersDir'      => APP_PATH . '/managers/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'compileDir'       => BASE_PATH . '/compiled/',
        'baseUri'        => '/',
    ]
]);
