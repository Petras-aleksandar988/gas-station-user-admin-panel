<?php require_once 'inc/header.php';

$user->logout();

echo '<script type="text/javascript">window.location = "login.php"</script>';
exit();
