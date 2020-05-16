<?php

class Item extends BaseModel{
  private $id;
  private $category_id;
  private $bantuan_id;
  private $nama;
  private $jumlah;

  public function initialize(){
    $this->belongsTo(
      'category_id',
      Category::class,
      'id',
      [
        'reusable' => true,
        'alias' => "category"
      ]
    );

    $this->belongsTo(
      'bantuan_id',
      Bantuan::class,
      'id',
      [
        'reusable' => true,
        'alias' => "bantuan",
      ]
    );
  }

  /**
   * @return mixed
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * @param mixed $created_at
   */
  public function setCreatedAt($created_at)
  {
    $this->created_at = $created_at;
  }

  /**
   * @return mixed
   */
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }

  /**
   * @param mixed $updated_at
   */
  public function setUpdatedAt($updated_at)
  {
    $this->updated_at = $updated_at;
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getCategoryId()
  {
    return $this->category_id;
  }

  /**
   * @param mixed $category_id
   */
  public function setCategoryId($category_id)
  {
    $this->category_id = $category_id;
  }

  /**
   * @return mixed
   */
  public function getBantuanId()
  {
    return $this->bantuan_id;
  }

  /**
   * @param mixed $bantuan_id
   */
  public function setBantuanId($bantuan_id)
  {
    $this->bantuan_id = $bantuan_id;
  }

  /**
   * @return mixed
   */
  public function getNama()
  {
    return $this->nama;
  }

  /**
   * @param mixed $nama
   */
  public function setNama($nama)
  {
    $this->nama = $nama;
  }

  /**
   * @return mixed
   */
  public function getJumlah()
  {
    return $this->jumlah;
  }

  /**
   * @param mixed $jumlah
   */
  public function setJumlah($jumlah)
  {
    $this->jumlah = $jumlah;
  }


}