<?php

namespace App\Managers;
use App\Models\User;

class UserManager extends BaseManager {
  public function find($parameters = null){
    return User::find($parameters);
  }

  public function create($data){
    $user = new User();
    $user->setNama($data['nama']);
    $user->setNik($data['nik']);
    $user->setJenisKelamin($data['jenis_kelamin']);

    if (false === $user->create()){
      foreach ($user->getMessages() as $message) {
        $error[] = (string) $message;
      }
      throw new \Exception(json_encode($error));
    }
    return $user;
  }

  public function update($id, $data){
    $user = User::findFirstById($id);
    if (!$user){
      throw new \Exception("User not found", 404);
    }
    $user->setNama($data['nama']);
    $user->setNik($data['nik']);
    $user->setJenisKelamin($data['jenis_kelamin']);
    if (false === $user->update()){
      foreach ($user->getMessages() as $message) {
        $error[] = (string) $message;
      }
      throw new \Exception(json_encode($error));
    }
  }
}