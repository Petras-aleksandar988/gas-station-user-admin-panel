<?php
require  "admin_header.php";

$gas_station_id = $_GET['id'];
$gas_station_obj = $gasStation->read($gas_station_id);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update_info'])) {
        $benzin95 = $_POST['benzin95'];
        $benzin98 = $_POST['benzin98'];
        $dizel = $_POST['dizel'];
        $gas = $_POST['gas'];

        $gasStation->updateGasStation($gas_station_id, $benzin95, $benzin98, $dizel, $gas);

        $_SESSION['message']['type'] = 'success';
        $_SESSION['message']['text'] = 'Employee ' . $gas_station_obj['name'] .  ' edited successfully!';
        echo '<script type="text/javascript">window.location = "gas_stations_list.php"</script>';
        exit();
    }
}

?>
<div class="container my-5 mx-auto">


    <div class="border border-secondary p-5 m-auto ">
        <h2>Edit Gas Station <?php echo $gas_station_obj['name'] ?> </h2>
        <form method='post'>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            Benzin95: <input type="text" class='form-control Benzin95-input' name='benzin95' value="<?php echo $gas_station_obj['benzin95'] ?>"><br>
            Benzin98: <input type="text" class='form-control Benzin98-input' name='benzin98' value="<?php echo $gas_station_obj['benzin98'] ?>"><br>
            Dizel: <input type="text" class='form-control Benzin98-input' name='dizel' value="<?php echo $gas_station_obj['dizel'] ?>"><br>
            Gas: <input type="text" class='form-control Benzin98-input' name='gas' value="<?php echo $gas_station_obj['gas'] ?>"><br>


    </div>

    </td><br>



    <input type="submit" name="update_info" class='btn btn-primary mt-3' value='Edit Gas Station'>
    </form>


</div>

</div>