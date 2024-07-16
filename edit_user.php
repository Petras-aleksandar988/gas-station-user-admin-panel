<?php
require "inc/header.php";

$user_obj = $user->read($_GET['id']);
$user_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['update_info'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = false;
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
      $email_error = 'Please insert your email.';
      $errors = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "The email address is not valid.";
      $errors = true;
    }
    if (!empty($password)  && strlen($password)  <  6) {
      $password_error = 'Password needs to have min 6 caracters.';
      $errors = true;
    }
    // If there are no errors and a new password is provided, hash it
    if (!empty($password)) {

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
      // If no new password provided or if password is not valid, keep the old one
      $hashed_password = $user_obj['password'];
    }

    // Validate email and password
    if (!$errors) {
      // Password is valid, proceed to hash it
      $user->updateSingleUser($user_id, $email, $hashed_password);
      $_SESSION['message']['type'] = 'success';
      $_SESSION['message']['text'] = 'Employee ' . $user_obj['name'] . ' ' . $user_obj['username']  . ' edited successfully!';
      echo '<script type="text/javascript">window.location = "index.php"</script>';
      exit();
    }
  }
}
?>
<div class="container my-5 mx-auto">

  <div class="border border-secondary p-5 m-auto ">
    <h2>Edit user</h2>
    <form method='post'>
      <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">

      Email : <input type="text" class='form-control' name='email' value="<?php echo htmlspecialchars($user_obj['email']); ?>">
      <p class="text-danger" id="name-error">
        <?php echo isset($email_error) ? $email_error : ""; ?>
      </p><br>
      New Password : <input type="password" class='form-control' name='password'>
      <p class="text-danger" id="name-error">
        <?php echo isset($password_error) ? $password_error : ""; ?>
      </p><br>

  </div>

  </td><br>



  <input type="submit" name="update_info" class='btn btn-primary mt-3' value='Edit user'>
  </form>


</div>

</div>