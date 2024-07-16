<?php include 'inc/header.php';

if ($user->isLogged()) {
    echo '<script type="text/javascript">window.location = "index.php"</script>';
    exit();
}

$admin_email = getenv('ADMIN_EMAIL');
$admin_password = getenv('ADMIN_PASSWORD');
$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
     unset($_SESSION['message']); 
    $errors = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $is_admin = ($email === $admin_email && $password === $admin_password);
    if (empty($email)) {
        $email_error = 'Please insert your email.';
        $errors = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "The email address is not valid.";
        $errors = true;
    }
    if (empty($password)) {
        $password_error = 'Please insert your password.';
        $errors = true;
    } elseif (strlen($password)  <  6) {
        $password_error = 'Password needs to have min 6 caracters.';
        $errors = true;
    }

    if (!$errors || $is_admin) {
        $userLogin = $user->login($email, $password);
        var_dump($userLogin);
        if($userLogin){

            $_SESSION['message']['type'] = 'success';
            $_SESSION['message']['text'] = 'Welcome!';
            echo '<script type="text/javascript">window.location = "index.php"</script>';
            exit();

        } else {
            $_SESSION['message']['type'] = 'danger';
            $_SESSION['message']['text'] = 'Credentials are incorrect!';
        }
    }

}

?>
  <?php if (isset($_SESSION['message'])) : ?>

<div class="alert alert-<?= $_SESSION['message']['type']; ?> alert-dismissible fade show" role="alert">

    <?php echo $_SESSION['message']['text'];
     unset($_SESSION['message']); 
    ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    
</div>
<?php endif; ?>


<div class="container my-5 mx-auto">


    <div class=" row border justify-content-center ">
        <div class="col-lg-12 m-3">

            <h2>Login User</h2>
            <form action="" method='post'>

                Email : <input type="text" class='form-control' name='email' value="<?php echo htmlspecialchars($email); ?>">
                <p class="text-danger" id="name-error">
                    <?php echo isset($email_error) ? $email_error : ""; ?>
                </p><br>
                Password : <input type="password" autocomplete class='form-control' name='password' value="<?php echo htmlspecialchars($password); ?>">
                <p class="text-danger" id="name-error">
                    <?php echo isset($password_error) ? $password_error : ""; ?>
                </p><br>


                <input type="submit" class='btn btn-primary mt-3' value='Login'>
            </form>

        </div>
    </div>
    <a href="register.php">REGISTER</a>
</div>


<?php include 'inc/footer.php' ?>