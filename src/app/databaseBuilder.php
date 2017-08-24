<?php
require 'connect.php';
class DatabaseBuilder
{
  protected $connect;
  function __construct()
  {
    $this->connect = new Connect();
  }

  public function buildUser()
  {
    $dbname = 'oborottest';
    $pdo = $this->connect->getDb();

    try {
      $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
      $pdo->exec($sql);
      $sql = "use $dbname";
      $pdo->exec($sql);
      $sql = "CREATE TABLE `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` LONGTEXT,
        `email` LONGTEXT,
        `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      $pdo->exec($sql);
      echo "Create table for users done.";
    } catch (Exception $e) {
      echo $e->getMessage()."\n";
      echo "Create table for users failure.";
    }

    $pdo = null;
  }
}
 ?>
