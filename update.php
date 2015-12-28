<?php
// CHANGING VALUES IN THIS FILE WILL BREAK THE SYSTEM
// Only used for nucleus system updates

require_once('config/settings.php');

$currentVersion = $intf->currentSystemVersion(array('variable' => 'nucleus'));

if ($currentVersion['value'] !== $version) {
  $identifier = array(
    'variable' => 'nucleus',
  );
  $values = array(
    'version' => $count,
    'value' => $version,
  );

  $intf->updateSystemVersion($identifier, $values);
}
