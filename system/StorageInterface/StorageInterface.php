<?php

class StorageInterface {
  protected $intf;

  public function __construct($settings) {
    $dbh = new DatabaseHandler($settings);
    $this->intf = $dbh->getDBConnection();
  }

  public function cmsInstalled() {
    if (!$this->intf->tableExists('System')) {
      print 'Simple-CMS is not installed please visit install.php to setup system.';
      die;
    }
  }

  public function install() {

  }

  public function addField($type, $variable, $var_type) {
    $table = $type . '_' . $variable;
    if ($this->intf->tableExists($table)) {
      return 'Variable machine name already exists';
    }

    $this->intf->addField($table, $var_type);
  }
}
