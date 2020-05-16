<?php

class Bantuan extends BaseModel{
  private $id;
  private $user_id;

  public function initialize(){
    $this->belongsTo(
      'user_id',
      User::class,
      'id',
      [
        'reusable' => true,
        'alias' => "user"
      ]
    );

    $this->hasMany(
      'id',
      Item::class,
      'bantuan_id',
      [
        'reusable' => true,
        'alias' => "items",
      ]
    );
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
  public function getUserId()
  {
    return $this->user_id;
  }

  /**
   * @param mixed $user_id
   */
  public function setUserId($user_id)
  {
    $this->user_id = $user_id;
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


}