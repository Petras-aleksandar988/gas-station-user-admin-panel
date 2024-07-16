<?php
require_once "inc/header.php";  ?>

<!DOCTYPE html>
<html>

<head>
    <title>Pending Approval</title>
</head>

<body class="text-center">
    <h1>Account Pending Approval</h1>
    <p>Your account has been created and is pending approval by an administrator. When you get notified please <a href="login.php" class="btn btn-primary">Login</a></p>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="' . $_SESSION['message']['type'] . '">' . $_SESSION['message']['text'] . '</div>';
        unset($_SESSION['message']);  // Clear the message after displaying it
    }
    ?>
</body>

</html>