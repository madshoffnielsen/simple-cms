<?php

class StorageInterface {
  protected $intf;

  public function __construct() {
    require(dirname(dirname(__DIR__)) . '/config/settings.php');

    $dbh = new DatabaseHandler($config['database']);
    $this->intf = $dbh->getDBConnection();
  }

  public function listAll($type) {
    return $this->intf->getAll($type);
  }
}
