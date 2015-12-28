<?php
// CHANGING VALUES IN THIS FILE WILL BREAK THE SYSTEM
// Only used for nucleus system updates

require_once('config/settings.php');

$currentVersion = $intf->currentSystemVersion(array('variable' => 'nucleus'));

if ($currentVersion < 1) {
  $identifier = array(
    'variable' => 'nucleus',
  );
  $values = array(
    'value' => $version,
  );

  $intf->updateSystemVersion($identifier, $values);
}

if ($currentVersion < 2) {
  $identifier = array(
    'variable' => 'nucleus',
  );
  $values = array(
    'value' => $version,
  );

  $intf->updateSystemVersion($identifier, $values);
}
