<?php
require_once "admin_header.php";

$user = new User();

$user_obj = $user->read($_GET['id']);
$gasStationObj =  $gasStation->read($user_obj['gas_station_id']);

$user_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update_info'])) {
        $firstname = $_POST['name'];
        $lastname = $_POST['username'];
        $years_of_experience = $_POST['years_of_experience'];
        $salary = $_POST['salary'];
        $vacation_days = $_POST['vacation_days'];
        $gas_station_id_update = intval($_POST['gas_station']);
        $user->update($user_id, $firstname, $lastname, $years_of_experience, $salary, $vacation_days, $gas_station_id_update);
        $_SESSION['message']['type'] = 'success';
        $_SESSION['message']['text'] = 'Employee ' . $firstname . ' ' . $lastname . ' edited successfully!';
        echo '<script type="text/javascript">window.location = "index.php"</script>';
        exit();
    }
}
?>

<div class="container my-5 mx-auto">
    <div class="border border-secondary p-5 m-auto ">
        <h2>Edit employee <?php echo $user_obj['name']  ?> <?php echo $user_obj['username']  ?></h2>
        <form method='post'>
            <input type="hidden" name="product_id" value="<?php echo $_GET['id'] ?>">
            First Name: <input required type="text" class='form-control' name='name' value="<?php echo $user_obj['name'] ?>"><br>
            Last Name: <input required type="text" class='form-control' name='username' value="<?php echo $user_obj['username'] ?>"><br>
            Years of experience: <input type="text" class='form-control' name='years_of_experience' value="<?php echo $user_obj['years_of_experience'] ?>"><br>
            Salary: <input type="text" class='form-control' name='salary' value="<?= $user_obj['salary'] ?>"><br>
            Vacation days: <input type="text" class='form-control' name='vacation_days' value="<?= $user_obj['vacation_days'] ?>"><br>
            <td>

                Current Gas Station (choose to change) :

                <select required name="gas_station" class='form-select'>
                    <!-- Selected option -->
                    <?php
                    $selectedGasStationId = $gasStationObj['id'];
                    $selectedGasStationName = $gasStationObj['name'];

                    // Check if the selected gas station ID exists in the database
                    $sql = "SELECT * FROM gas_stations WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $selectedGasStationId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $gasStationExists = $result->num_rows > 0;

                    // Display selected gas station as the selected option if it exists
                    if ($gasStationExists) {
                        echo "<option selected style='color: red;' value='$selectedGasStationId'>$selectedGasStationName</option>";
                    } else {
                        // Display a default option indicating that the gas station no longer exists
                        echo "<option disabled style='color: red;'>Gas station no longer exists</option>";
                    }

                    // Display other gas stations
                    $sql = "SELECT * FROM gas_stations";
                    $run = $conn->query($sql);
                    $results = $run->fetch_all(MYSQLI_ASSOC);

                    foreach ($results as $result) {
                        // Skip the selected gas station since it's already displayed
                        if ($result['id'] != $selectedGasStationId) {
                            echo "<option value='" . $result['id'] . "'>" . $result['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <br>
                <div class="d-flex align-items-center ">

                    <p class="mx-2"> Status: </p>

                    <?php if ($user_obj['status'] == 1) {
                        echo  '<p class= "btn btn-success "><a class="text-light" href= "status.php?id=' . $user_id . '&status=0"> Enabled </a></p>';
                    } else {
                        echo  '<p class= "btn btn-danger "><a  class="text-light" href= "status.php?id=' . $user_id . '&status=1"> Disabled </a></p>';
                    } ?>
                </div>

            </td><br>



            <input type="submit" name="update_info" class='btn btn-primary mt-3' value='Edit user'>
        </form>


    </div>

</div>