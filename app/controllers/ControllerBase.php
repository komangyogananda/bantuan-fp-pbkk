<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    // Implement common logic
  public function beforeExecuteRoute(Dispatcher $dispatcher){
    $session = $this->di->getShared("session");
    $user = $session->get('user');
    if (!$user && $dispatcher->getControllerName() != "user"){
      $this->response->redirect('user/login');
      return false;
    }
  }
}
