<?php

class BantuanController extends ControllerBase {
  public function sayaAction($params = -1){
    $user = $this->di->getShared("session")->get("user");
    $selected_category = $this->request->getQuery('category');
    if ($this->request->isAjax()){
      $bantuan_manager = $this->di->getShared("bantuan_manager");
      $bantuans = $bantuan_manager->myBantuan($user->getId());
      $dataTable = array();
      foreach ($bantuans as $bantuan){
        $row = array(
          "itemsLength" => count($bantuan->items),
          "createdAt" => $bantuan->getCreatedAt(),
          "items" => array()
        );
        foreach($bantuan->items as $item){
          $dataItem = array(
            "nama"=> $item->nama,
            "category" => $item->category->nama,
            "jumlah" => $item->jumlah
          );
          if ($selected_category == null){
            array_push($row["items"], $dataItem);
          }else if ($item->category->getId() == $selected_category){
            array_push($row["items"], $dataItem);
          }
        }
        if (count($row["items"]) != 0){
          array_push($dataTable, $row);
        }
      }
      
      $this->view->disable();
      $response = new \Phalcon\Http\Response();
      $response->setHeader("Access-Control-Allow-Origin", "*");
      $response->setContent(json_encode($dataTable));
      $response->setHeader("Content-type", "application/json; charset=UTF-8");
      return $response;
    }else{
      $this->view->user = $user;
      $this->view->categories = $this->di->getShared("category_manager")->all();
      $this->view->selected_category = $selected_category;
      if ($selected_category == null){
        $this->view->selected_category = -1;
      }
    }
  }

  public function tambahAction(){
    if ($this->request->isPost()){
      $arrayItems = $this->request->getJsonRawBody();
      $user = $this->di->getShared("session")->get("user");
      if ($arrayItems){
        $this->db->begin();
        try{
          $bantuan_manager = $this->di->getShared("bantuan_manager");
          $item_manager = $this->di->getShared("item_manager");
          $bantuan = $bantuan_manager->create($user->getId());
          foreach ($arrayItems as $item_data){
            $item = $item_manager->create($item_data->nama, $bantuan->getId(), $item_data->category_id, $item_data->jumlah);
            print_r($item->getId());
          }
          $this->db->commit();
          $this->view->disable();
          $response = new \Phalcon\Http\Response();
          $response->setJsonContent([
            'status' => 'success'
          ]);
          return $response;
        }catch (\Exception $e){
          echo $e->getMessage();
          $this->db->rollback();
          $response = new \Phalcon\Http\Response();
          $response->setJsonContent([
            'status' => $e->getMessage()
          ]);
          return $response;
        }
      }
    }else{
      $this->view->user = $this->di->getShared("session")->get("user");
      $this->view->categories = $this->di->getShared("category_manager")->all();
    }
  }

  public function listAction($category = null){
    $selected_category = $this->request->getQuery('category');
    if ($this->request->isAjax()){
      $this->view->disable();
      $bantuan_manager = $this->di->getShared("bantuan_manager");
      $bantuans = $bantuan_manager->all($category);
      $dataTable = array();
      foreach ($bantuans as $bantuan){
        $row = array(
          "user" => $bantuan->user->nama,
          "itemsLength" => count($bantuan->items),
          "createdAt" => $bantuan->getCreatedAt(),
          "items" => array()
        );
        foreach($bantuan->items as $item){
          $dataItem = array(
            "nama"=> $item->nama,
            "category" => $item->category->nama,
            "jumlah" => $item->jumlah
          );
          if ($selected_category == null){
            array_push($row["items"], $dataItem);
          }else if ($item->category->getId() == $selected_category){
            array_push($row["items"], $dataItem);
          }
        }
        if (count($row["items"]) != 0){
          array_push($dataTable, $row);
        }
      }
      $response = new \Phalcon\Http\Response();
      $response->setHeader("Access-Control-Allow-Origin", "*");
      $response->setContent(json_encode($dataTable));
      $response->setHeader("Content-type", "application/json; charset=UTF-8");
      return $response;

    }else{
      $this->view->user = $this->di->getShared("session")->get("user");
      $this->view->categories = $this->di->getShared("category_manager")->all();
      $this->view->selected_category = $selected_category;
      if ($selected_category == null){
        $this->view->selected_category = -1;
      }
    }
  }
}