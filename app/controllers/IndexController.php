<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function indexAction(){
      $session = $this->di->getShared('session');
      $user = $session->get('user');
      if ($user){
        $this->view->user = $user;
      }else{
        $this->response->redirect("user/login");
      }
    }

}

