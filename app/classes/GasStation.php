<?php

class GasStation
{

  protected $connection;

  public function __construct()
  {
    global $conn;
    $this->connection = $conn;
  }

  public function create($name,  $benzin95, $benzin98, $dizel, $gas) {
    $sql = "INSERT INTO gas_stations (name,benzin95,benzin98,dizel,gas)
        VALUES (?,?,?,?,?)";

    $stmt = $this->connection->prepare($sql);

    $stmt->bind_param("sssss", $name, $benzin95, $benzin98, $dizel, $gas);

    $result = $stmt->execute();
  }


  public function read($gas_station_id){

    $sql = "SELECT *  FROM gas_stations WHERE id = ?";

    $stmt = $this->connection->prepare($sql);

    $stmt->bind_param("i", $gas_station_id);

    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_assoc();
  }


  public function updateGasStation($gas_station_id, $benzin95, $benzin98, $dizel, $gas){

    $sql = "UPDATE gas_stations SET benzin95 = ?, benzin98 = ?, dizel = ?, gas = ? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->bind_param("ssssi",  $benzin95, $benzin98, $dizel, $gas, $gas_station_id);
    $stmt->execute();
  }


  public function delete($gas_station_id){
    $stmt = $this->connection->prepare("DELETE from gas_stations where id = ?");
    $stmt->bind_param("s", $gas_station_id);
    $stmt->execute();
  }


  public function fetch_all_gas_stations(){
    $sql = 'SELECT * FROM gas_stations ORDER BY name ASC';
    $results = $this->connection->query($sql);
    return $results->fetch_all(MYSQLI_ASSOC);
  }
}
