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
    include(dirname(dirname(__DIR__)) . '/config/variables.php');
    // Setup system variables table
    $table_name = 'system';
    $columns = array(
      'variable VARCHAR(256) PRIMARY KEY',
      'active BOOLEAN NOT NULL',
      'version VARCHAR(256) NOT NULL DEFAULT 0',
    );
    $this->intf->addTable($table_name, $columns);

    // Insert current system version
    $variables = array(
      'variable' => 'nucleus',
      'active' => '1',
      'version' => $version,
    );
    $this->intf->addVariable($table_name, $variables);

    // Setup content types table
    $table_name = 'content_types';
    $columns = array(
      'ctid INT(11) AUTO_INCREMENT PRIMARY KEY',
      'name VARCHAR(256) NOT NULL',
      'description VARCHAR(256) NOT NULL',
      'fields BLOB NOT NULL',
    );
    $this->intf->addTable($table_name, $columns);
  }
}
