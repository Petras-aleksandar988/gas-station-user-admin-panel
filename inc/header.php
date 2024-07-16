<?php
session_start();
require_once 'app/config/config.php';
require_once 'app/classes/User.php';
require_once 'app/classes/GasStation.php';

$user = new User();
$gasStation = new GasStation();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Gas Station employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">

        <div class="container">
            <a href="index.php" class="nav-link">Home</a>
            <div class=" d-flex justify-content-between" id="navbarNav">

                </ul>
                <ul class="navbar-nav ml-auto  d-flex  flex-row gap-2">


                    <?php if (!$user->isLogged()) : ?>

                        <li class="nav-item ">
                            <a href="register.php" class="nav-link">Register</a>
                        </li>
                        <li class="nav-item ">
                            <a href="login.php" class="nav-link">Login</a>
                        </li>
                    <?php else : ?>


                        <li class="nav-item ">
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                        </li>

                    <?php endif ?>
                </ul>

            </div>
        </div>
    </nav>
    <?php if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['message']['type']; ?> alert-dismissible fade show" role="alert">

            <?php echo $_SESSION['message']['text'];
            unset($_SESSION['message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            
        </div>
        <?php endif; ?>
        <?php  ?>
        