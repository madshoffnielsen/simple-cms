<?php
function __autoload($class_name) {
  require_once "./system/" . $class_name . "/" . $class_name . ".php";
}

function arg($nbr = -1) {
  $arg = explode('/', $_SERVER['PHP_SELF']);

  if ($nbr == -1) {
    return $arg;
  }
  else if ($nbr < count($arg)) {
    return $arg[$nbr];
  }
  else {
    return;
  }
}

$intf = new StorageInterface($config['database']);
$installed = $intf->cmsInstalled();

if ($installed) {
  if (arg(2) === 'install.php') {
    print 'TODO install system';
  }
  else {
    print $installed;
  }
}
else {
  print 'ok';
}
