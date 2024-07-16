<?php
require  "admin_header.php";

$allGasStations = $gasStation->fetch_all_gas_stations();
$allUsers = $user->fetch_all_users();
?>

<form class="m-3" method='POST' action="add_gas_station.php">

   <input type="submit" class='btn btn-primary mt-3' value='ADD New Gas Station'>
</form>
<div class=" mx-3">
   <div class="">

      <div class="col-md-12 border border-secondary mx-auto">
         <h2>Gas Stations List</h2>
         <!-- <a href="employees.php" class="btn btn-success my-1">Employee List</a> -->
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Benzin95</th>
                  <th>Benzin98</th>
                  <th>Dizel</th>
                  <th>Gas</th>
                  <th>Total Workers</th>
               </tr>
               <thead>
               <tbody>
                  <?php foreach ($allGasStations  as $gasStation) : ?>
                     <tr>
                        <td><?= $gasStation['name']  ?></td>
                        <td><?= $gasStation['benzin95']  ?></td>
                        <td><?= $gasStation['benzin98']  ?></td>
                        <td><?= $gasStation['dizel']  ?></td>
                        <td><?= $gasStation['gas']  ?></td>

                        <td>
                           <?php
                           // Count the number of workers for this gas station
                           $workerCount = 0;
                           foreach ($allUsers as $user) {
                              if ($user['gas_station_id'] == $gasStation['id']) {
                                 $workerCount++;
                              }
                           }
                           echo $workerCount;
                           ?>
                        </td>

                        <td>

                           <div class="button-container d-flex gap-1">
                              <a href="edit_gas_station_admin.php?id=<?= $gasStation['id'] ?>" class="btn btn-primary">Edit</a>
                              <a href="delete_gas_station.php?id=<?= $gasStation['id']  ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
                           </div>

                        </td>

                     </tr>
                  <?php endforeach ?>

               </tbody>
         </table>

      </div>
   </div>
</div>
<script>
   function confirmDelete() {
      return confirm('Are you sure you want to delete this gas station?');
   }
</script>

<?php require_once "admin_footer.php"; ?>