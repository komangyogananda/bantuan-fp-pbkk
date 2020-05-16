<?php

class CategoryManager extends BaseManager {
  public function all(){
    return Category::find();
  }
}