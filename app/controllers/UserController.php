<?php
declare(strict_types=1);

use Phalcon\Security;

class UserController extends ControllerBase
{

  public function loginAction(){
    if ($this->request->isPost()){
      $user_manager = $this->di->getShared("user_manager");
      $security = new Security();
      $username = $this->request->getPost("username");
      $password = $this->request->getPost("password");
      try {
        $user = $user_manager->find($username);
        if (!$user){
          throw new Exception("Username tidak ada", 404);
        }
        if ($security->checkHash($password, $user->getPassword())){
          $session = $this->di->getShared("session");
          $session->set("user", $user);
          $this->response->redirect('/');
        }else{
          throw new Exception("Password salah", 404);
        }
      } catch (\Exception $e){
        $this->flash->error($e->getMessage());
      }
    }
  }

  public function registerAction(){
    if ($this->request->isPost()){
      $user_manager = $this->di->getShared("user_manager");
      $security = new Security();
      try {
        $params = [
          'username' => $this->request->getPost("username"),
          'nama' => $this->request->getPost("nama"),
          'nik' => $this->request->getPost("nik"),
          'password' => $security->hash($this->request->getPost("password")),
          'jenisKelamin' => $this->request->getPost("jenisKelamin"),
        ];
        $user_manager->create($params);
        $this->response->redirect('user/login');
      } catch (\Exception $e){
        $this->flash->error("Terjadi kesalahan.");
      }
    }
  }

  public function logoutAction(){
    $this->view->disable();
    $this->di->getShared('session')->remove("user");
    $this->response->redirect('user/login');
  }

}

