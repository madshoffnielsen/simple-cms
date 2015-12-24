<?php

require_once('config/settings.php');

if (isset($_POST['submit'])) {
  $intf->install();
}
else {
?>
<form method="post">
  <input type="submit" name="submit" value="Install system">
</form>
<?php
}
