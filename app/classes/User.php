<?php

class User
{
  protected $connection;

  public function __construct()
  {
    global $conn;
    $this->connection = $conn;
  }

  public function create($name, $usernamame, $email, $password, $status, $gas_station){

    $hased_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name,username,email,password,status, gas_station_id)
        VALUES (?,?,?,?,?,?)";

    $stmt = $this->connection->prepare($sql);

    $stmt->bind_param("ssssii", $name, $usernamame, $email, $hased_password, $status, $gas_station);

    $result = $stmt->execute();

    if ($result) {
      $_SESSION['pending'] = 'pending';
      return true;
    } else {
      return false;
    }
  }


  public function read($user_id){

    $sql = "SELECT *  FROM users WHERE user_id = ?";

    $stmt = $this->connection->prepare($sql);

    $stmt->bind_param("i", $user_id);

    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_assoc();
  }


  public function update($user_id, $fistname, $lastname, $years_of_experience, $salary, $vacation_days, $gas_station_id_update){
    $sql = "UPDATE users SET name = ?,username = ?, years_of_experience = ?, salary = ?, vacation_days = ?, gas_station_id = ? WHERE user_id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->bind_param("sssiiii", $fistname, $lastname, $years_of_experience, $salary, $vacation_days, $gas_station_id_update, $user_id);
    $stmt->execute();
  }


  public function updateSingleUser($user_id, $email, $password){
    $sql = "UPDATE users SET email = ?, password = ? WHERE user_id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->bind_param("ssi", $email, $password, $user_id);
    $stmt->execute();
  }


  public function updateStatus($user_id, $status){

    $sql = "UPDATE users SET status = ? WHERE user_id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->bind_param("ii", $status, $user_id);
    $stmt->execute();
  }


  public function delete($user_id){
    $stmt = $this->connection->prepare("DELETE from users where user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
  }


  public function register(){
    $sql = "SELECT name, email FROM users";

    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data;
  }


  public function login($email, $password){
    $sql = "SELECT user_id, password,status FROM users WHERE email  = ?";

    $stmt = $this->connection->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
      $user = $result->fetch_assoc();

      if (password_verify($password, $user['password'])) {

        if ($user['status'] == 1) {
          $_SESSION['user_id'] = $user['user_id'];
          return true;
        } else {
          $_SESSION['pending'] = true;
          echo '<script type="text/javascript">window.location = "pending_approval.php"</script>';
          exit();
        }
      }
    }
    return false;
  }


  public function isLogged(){
    if (isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
  }


  public function notApproved(){
    if (isset($_SESSION['pending'])) {
      return true;
    } else {
      return false;
    }
  }


  public function isAdmin(){

    $sql = "SELECT * from users where user_id = ? and is_admin = 1";

    $stmt = $this->connection->prepare($sql);

    $stmt->bind_param("s", $_SESSION['user_id']);

    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return true;
    }
    return false;
  }


  public function logout()
  {
    unset($_SESSION['user_id']);
  }


  public function fetch_all_users(){
    $sql = 'SELECT * FROM users ORDER BY is_admin DESC, name ASC';
    $results = $this->connection->query($sql);
    return $results->fetch_all(MYSQLI_ASSOC);
  }


  public function get_gas_station_name($user_id){
    $sql = "SELECT users.*, 
    gas_stations.name AS  gas_station_name,
    gas_stations.id AS  gas_station_id
FROM users
LEFT JOIN gas_stations ON users.gas_station_id = gas_stations.id
WHERE users.user_id = ?";

    $stmt =  $this->connection->prepare($sql);

    if ($stmt) {
      $stmt->bind_param("i", $user_id);
      $stmt->execute();

      return $stmt->get_result()->fetch_assoc();
    } else {
      die("Error: " .  $this->connection->error);
    }
  }
  
}
