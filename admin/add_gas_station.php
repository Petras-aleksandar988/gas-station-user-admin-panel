<?php

require  "admin_header.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_gas_station'])) {

  $name = $_POST['name'];
  $benzin95 = $_POST['benzin95'];
  $benzin98 = $_POST['benzin98'];
  $dizel = $_POST['dizel'];
  $gas = $_POST['gas'];

  $gasStation->create($name, $benzin95, $benzin98, $dizel, $gas);
  $_SESSION['message']['type'] = 'success';
  $_SESSION['message']['text'] = 'Gas Station ' . $name .  'added successfully!';
  echo '<script type="text/javascript">window.location = "gas_stations_list.php"</script>';
  exit();
}

?>

<div class="container" style="margin-top: 90px;">

  <div class="row">
    <div class="col-md-12 border border-secundary p-2">
      <h2>ADD New Gas Station</h2>
      <form method='POST'>
        Name: <input required type="text" class='form-control' name='name'><br>
        Benzin95: <input required type="text" class='form-control' name='benzin95'><br>
        Benzin98: <input required type="text" class='form-control' name='benzin98'><br>
        Dizel: <input required type="text" class='form-control' name='dizel'><br>
        gas: <input required type="text" class='form-control' name='gas'><br>




        <input type="submit" class='btn btn-primary mt-3' name="add_gas_station" value='ADD Gas Station'>
      </form>
    </div>
  </div>
</div>