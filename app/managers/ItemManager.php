<?php

class ItemManager extends BaseManager {
  public function create($nama, $bantuan_id, $category_id, $jumlah){
    $item = new Item();
    $item->setNama($nama);
    $item->setBantuanId($bantuan_id);
    $item->setCategoryId($category_id);
    $item->setJumlah($jumlah);
    if (false === $item->create()){
      foreach ($item->getMessages() as $message) {
        $error[] = (string) $message;
      }
      throw new \Exception(json_encode($error));
    }
    return $item;
  }
}