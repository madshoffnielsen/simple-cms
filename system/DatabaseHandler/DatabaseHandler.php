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

  public function DBversion() {
    return $this->dbh->query('select version()')->fetchColumn();
  }

  public function addTable($table_name, array $columns) {
    $sql = "CREATE TABLE IF NOT EXISTS $table_name";
    $sql .= '(' . implode(', ', $columns) . ');"';
    $this->dbh->exec($sql);
  }

  public function addVariable($table_name, array $variables) {
    $column = implode(",", array_keys($variables));
    $value = "'" . implode("','", array_values($variables)) . "'";

    $sql = "INSERT INTO $table_name($column) VALUES ($value)";
    $this->dbh->query($sql);
  }

  public function tableExists($table) {
    try {
        $result = $this->dbh->query("SELECT 1 FROM $table LIMIT 1");
    } catch (Exception $e) {
        // We got an exception == table not found
        return FALSE;
    }

    // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
    return $result !== FALSE;
  }

}
