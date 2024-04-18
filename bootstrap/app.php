<?php

require __DIR__.'/../vendor/autoload.php';

use App\Core\View;
use App\Core\Database;
use App\Core\Environment;

// Middlewares
use \App\Http\Middlewares\RequireAdminLogin;
use \App\Http\Middlewares\RequireAdminLogout;
use App\Http\Middlewares\RequireUserToBeATeacher;
use \App\Http\Middlewares\Queue as MiddlewareQueue;
use App\Http\Middlewares\RequireUserToBeACollaborator;

Environment::load(__DIR__.'/../');

if(getenv('APP_DEBUG')) {
  ini_set('display_errors', 1); 
  ini_set('display_startup_errors', 1); 
  error_reporting(E_ALL);
}

Database::config(
  getenv('DB_HOST'),
  getenv('DB_NAME'),
  getenv('DB_USER'),
  getenv('DB_PASS'),
  getenv('DB_PORT')
);

define('ROOT', dirname(__DIR__));
define('URL', getenv('BASE_URL'));
define('URL_ADMIN', getenv('BASE_URL').'/admin');
define('URL_UPLOAD', URL.'/upload');
define('UPLOAD', ROOT.'/upload');

// Definindo o mapeamento de middlewares
MiddlewareQueue::setMap([
  'required-admin-logout'      => RequireAdminLogout::class,
  'required-admin-login'       => RequireAdminLogin::class,
  'required-user-teacher'      => RequireUserToBeATeacher::class,
  'required-user-student'      => RequireUserToBeStudent::class,
  'required-user-coordinator'  => RequireUserToBeACoordinator::class,
  'required-user-collaborator' => RequireUserToBeACollaborator::class,
]);

View::init([
  'URL' => URL,
  'URL_ADMIN' => URL_ADMIN,
  'UPLOAD' => URL.'/upload'
]);
