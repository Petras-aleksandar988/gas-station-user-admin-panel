<?php
require  "admin_header.php";

$allUsers = $user->fetch_all_users();
$allgasStations = $gasStation->fetch_all_gas_stations();
?>

<div class=" mx-3">
   <div class="">

      <div class="col-md-12 border border-secondary mx-auto">

         <h2>Employees List</h2>
         <!-- <a href="employees.php" class="btn btn-success my-1">Employee List</a> -->
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
                  <th>Status</th>


               </tr>

               <thead>
               <tbody>
                  <?php foreach ($allUsers  as $user) : ?>
                     <tr>
                        <td><?= $user['name']  ?></td>
                        <td><?= $user['username']  ?></td>
                        <td><?= $user['email']  ?></td>
                        <td><?= $user['years_of_experience']  ?></td>
                        <td><?= $user['salary']  ?></td>
                        <td><?= $user['vacation_days']  ?></td>

                        <td>
                           <?php
                           // Fetch the gas station name based on the gas_station_id
                           $gasStationId = $user['gas_station_id'];
                           $gasStationName = '';
                           foreach ($allgasStations as $station) {
                              if ($station['id'] == $gasStationId) {
                                 $gasStationName = $station['name'];
                                 break;
                              }
                           }
                           echo $gasStationName;
                           ?>
                        </td>

                        <td>

                           <?php

                           if ($user['status'] == 1) {
                              echo  '<p class= "text-success"> Enebled </p>';
                           } else {
                              echo  '<p class= "text-danger"> Disabled </p>';
                           }
                           ?></td>



                        <td>
                           <?php if ($user['is_admin'] == 1) : ?>
                              <span class="badge bg-info text-dark">Admin</span>
                           <?php else : ?>
                              <div class="button-container d-flex gap-1">
                                 <a href="edit_user_admin.php?id=<?= $user['user_id'] ?>" class="btn btn-primary">Edit</a>
                                 <a href="delete_user.php?id=<?= $user['user_id']  ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
                              </div>
                           <?php endif; ?>

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
      return confirm('Are you sure you want to delete this user?');
   }
</script>

<?php require_once "admin_footer.php"; ?>