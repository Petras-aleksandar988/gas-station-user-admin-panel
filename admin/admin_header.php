<?php
session_start();
require  "../app/config/config.php";
require  "../app/classes/User.php";
require  "../app/classes/GasStation.php";
$user = new User();
$gasStation = new GasStation();
if (!$user->isLogged() && !$user->isAdmin()) {
    echo '<script type="text/javascript">window.location = "../index.php"</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>admin panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container d-flex justify-content-between ">
            <div>
                <a href="index.php" class="nabar-brand  h4 text-decoration-none">Admin panel</a>
                <a href="index.php" class="btn btn-success m-3">Employees List</a>
                <a href="gas_stations_list.php" class="btn btn-success m-3">Gas Stations List</a>

            </div>
            <a href="../logout.php" class="btn btn-danger my-1">Logout</a>
    </nav>

    <?php if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['message']['type']; ?> alert-dismissible fade show" role="alert">

            <?php echo $_SESSION['message']['text'];
            unset($_SESSION['message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    <?php endif; ?>
