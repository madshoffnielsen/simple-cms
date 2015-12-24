<?php

class StorageInterface {
  protected $intf;

  public function __construct($settings) {
    $dbh = new DatabaseHandler($settings);
    $this->intf = $dbh->getDBConnection();
  }

  public function getDBversion() {
    return $this->intf->DBversion();
  }

  public function cmsInstalled() {
    if (!$this->intf->tableExists('system')) {
      return 'Simple-CMS is not installed please visit <a href="install.php">install page</a> to setup system.';
    }
    return FALSE;
  }

  public function install() {
    $table_name = 'system';
    $columns = array(
      'Variable VARCHAR(256) PRIMARY KEY',
      'Value VARCHAR(256) NOT NULL DEFAULT 0',
      'Version VARCHAR(256) NOT NULL DEFAULT 0',
    );

    $this->intf->addTable($table_name, $columns);
  }
}
