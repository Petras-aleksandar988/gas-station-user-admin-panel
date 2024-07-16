
<?php
require "admin_header.php";

if (isset($_GET['id'])) {
   $gasStation->delete($_GET['id']);
   $_SESSION['message']['type'] = 'success';
   $_SESSION['message']['text'] = 'Gas Station deleted successfully!';

   echo '<script type="text/javascript">window.location = "gas_stations_list.php"</script>';
   exit();
}

?>