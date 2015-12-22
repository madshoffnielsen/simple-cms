<?php
function __autoload($class_name) {
  require_once "./system/" . $class_name . "/" . $class_name . ".php";
}

$intf = new StorageInterface($config['database']);
$intf->cmsInstalled();
