<?php
require "admin_header.php";

if (isset($_GET['id'])) {
   $user->delete($_GET['id']);
   $_SESSION['message']['type'] = 'success';
   $_SESSION['message']['text'] = 'User deleted successfully!';

   echo '<script type="text/javascript">window.location = "index.php"</script>';
   exit();
}
