<?php

class Category extends BaseModel{
  private $id;
  private $nama;
  private $deskripsi;

  public function initialize(){
    $this->hasMany(
      'id',
      Item::class,
      'category_id',
      [
        'reusable' => true,
        'alias' => 'items'
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
  public function getDeskripsi()
  {
    return $this->deskripsi;
  }

  /**
   * @param mixed $deskripsi
   */
  public function setDeskripsi($deskripsi)
  {
    $this->deskripsi = $deskripsi;
  }


}