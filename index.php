<?php
require_once "inc/header.php";

if ($user->isAdmin()) {
    echo '<script type="text/javascript">window.location = "admin/index.php"</script>';
    exit();
}
if (!$user->isLogged()) {
    echo '<script type="text/javascript">window.location = "login.php"</script>';
    exit();
} else {
    $user_obj =  $user->get_gas_station_name($_SESSION['user_id']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update_info'])) {
        $firstname = $_POST['name'];
        $lastname = $_POST['username'];
        $years_of_experience = $_POST['years_of_experience'];
        $salary = $_POST['salary'];
        $vacation_days = $_POST['vacation_days'];
    }
}
?>

<div class=" mx-3">
    <div class="">

        <div class="col-md-12 border border-secondary mx-auto">

            <h2>Employee <?= $user_obj['name']  ?> <?= $user_obj['username']  ?> </h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Years of experience</th>
                        <th>Salary</th>
                        <th>Vacation days</th>
                        <th>Gas Station</th>


                    </tr>

                    <thead>
                    <tbody>
                        <tr>
                            <td><?= $user_obj['name']  ?></td>
                            <td><?= $user_obj['username']  ?></td>
                            <td><?= $user_obj['email']  ?></td>
                            <td><?= $user_obj['years_of_experience']  ?></td>
                            <td><?= $user_obj['salary']  ?></td>
                            <td><?= $user_obj['vacation_days']  ?></td>


                            <td>
                                <?php if ($user_obj['gas_station_id'] != 0) {
                                    echo $user_obj['gas_station_name'];
                                } else {
                                    echo "No Gas Station";
                                }  ?>

                            </td>

                            <td>
                                <a href="gas_station.php?id=<?= $user_obj['gas_station_id'] ?>" class="btn btn-primary"><?= $user_obj['gas_station_name']  ?></a>

                            </td>
                            <td>
                                <a href="edit_user.php?id=<?= $user_obj['user_id'] ?>" class="btn btn-primary">Edit User</a>

                            </td>

                        </tr>

                    </tbody>
            </table>

        </div>
    </div>
</div>



<?php require_once "inc/footer.php"; ?>