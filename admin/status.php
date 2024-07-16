<?php
require  "admin_header.php";
$user_id  = $_GET['id'];
$status  = $_GET['status'];
$user->updateStatus($user_id, $status);

echo '<script type="text/javascript">window.location = "edit_user_admin.php?id=' . $user_id . '";</script>';
