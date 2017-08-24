<?php
require 'connect.php';
require 'userModel.php';
class UserService
{
  protected $dbname = "oborottest";
  protected $connect;
  function __construct()
  {
      $this->connect = new Connect();
  }

  public function getAll()
  {
    $data = null;
    $sql = "select id, name, email from users";
    $pdo = $this->connect->getDb($this->dbname);
    if (!is_null($pdo)) {
      $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "User");
      $pdo = null;
    }

    return $data;
  }

  public function getById($id)
  {
    $data = null;
    $sql = "select id, name, email from users where id='$id'";
    $pdo = $this->connect->getDb($this->dbname);
    if (!is_null($pdo)) {
      $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "User");
      $pdo = null;
    }

    return $data;
  }

  public function add($user)
  {
    $count = 0;
    $sql = 'INSERT INTO users (name, email) VALUES (:name, :email)';
    $pdo = $this->connect->getDb($this->dbname);
    if(!is_null($pdo)) {
      $sth = $pdo->prepare($sql);
      $count = $sth->execute(array(':name' => $user->name,':email' => $user->email));
      $pdo = null;
    }
    return $count;
  }

  public function update($id, $user)
  {
      $array = array();
      if (!empty($user->name)) {
        $array[] = "name='$user->name'";
      }
      if (!empty($user->email)) {
        $array[] = "email='$user->email'";
      }
      $array = implode(",", $array);
      $count = 0;
      $sql ="UPDATE users set $array where id='$id'";
      $pdo = $this->connect->getDb($this->dbname);
      if(!is_null($pdo)) {
          $count = $pdo->exec($sql);
          $pdo = null;
      }
      return $count;
  }

}
 ?>
