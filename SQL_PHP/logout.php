<?php
session_start();
session_destroy();
header("Location: ../../templates/all/index.php");
exit();
?>
