<?php

class User extends BaseModel {
  private $id;
  private $nama;
  private $nik;
  private $jenis_kelamin;
  private $password;
  private $username;

  public function initialize(){
    $this->hasMany(
      "id",
      Bantuan::class,
      'user_id',
      [
        'reusable'=> true,
        'alias' => "bantuan",
      ]
    );
  }

  /**
   * @return mixed
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * @param mixed $password
   */
  public function setPassword($password)
  {
    $this->password = $password;
  }

  /**
   * @return mixed
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * @param mixed $username
   */
  public function setUsername($username)
  {
    $this->username = $username;
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
  public function getNik()
  {
    return $this->nik;
  }

  /**
   * @param mixed $nik
   */
  public function setNik($nik)
  {
    $this->nik = $nik;
  }

  /**
   * @return mixed
   */
  public function getJenisKelamin()
  {
    return $this->jenis_kelamin;
  }

  /**
   * @param mixed $jenis_kelamin
   */
  public function setJenisKelamin($jenis_kelamin)
  {
    $this->jenis_kelamin = $jenis_kelamin;
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