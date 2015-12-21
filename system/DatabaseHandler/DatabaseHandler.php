<?php

class DatabaseHandler {
  protected $dbh;

  public function __construct(array $config) {
    try {
      $con = new PDO('mysql:host='.$config['db_host'].'; dbname='.$config['db_name'], $config['db_user'], $config['user_pw']);
      $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      // $con->exec("SET CHARACTER SET utf8");

      $this->dbh = $con;
    }
    catch (PDOException $err) {
      echo "Database connection error";
      $err->getMessage() . "<br/>";
      file_put_contents('PDOErrors.txt',$err, FILE_APPEND);
      die();
    }
  }

  public function getDBConnection() {
    return $this;
  }

  public function getAll($type) {
    // TODO check safe input
    $query = $this->dbh->query("SELECT * FROM $type");
    $query->execute();
    return $query->fetchAll();
  }
}
