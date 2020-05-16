<?php

class BantuanManager extends BaseManager {
  public function create($id){
    $bantuan = new Bantuan();
    $bantuan->setUserId($id);
    if (false === $bantuan->create()){
      foreach ($bantuan->getMessages() as $message) {
        $error[] = (string) $message;
      }
      throw new \Exception(json_encode($error));
    }
    return $bantuan;
  }

  public function all($category){
    $all_bantuan = Bantuan::find();
    return $all_bantuan;
  }

  public function myBantuan($id){
    $bantuans = Bantuan::find([
      "id"=>$id
    ]);
    return $bantuans;
  }
}