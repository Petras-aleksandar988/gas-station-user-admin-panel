<?php
require_once "inc/header.php";

$name = '';
$user_name = '';
$email = '';
$password = '';
if ($user->notApproved()) {
    echo '<script type="text/javascript">window.location = "pending_approval.php"</script>';
    exit();
}
if ($user->isLogged()) {
    echo '<script type="text/javascript">window.location = "index.php"</script>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gas_station = $_POST['gas_station'];
    $user = new User();
    $registerUsers = $user->register();
    foreach ($registerUsers as $row) {

        if ($row['name'] == $name || $row['email'] == $email) {
            $_SESSION['message']['type'] = 'danger';
            $_SESSION['message']['text'] = 'Name or email alerady exist!Please use another credentials to register!';
            echo '<script type="text/javascript">window.location = "register.php"</script>';
            exit();
        }
    }


    $errors = false;
    if (empty($name)) {
        $first_name_error = 'Please insert your first name.';
        $errors = true;
    }
    if (empty($user_name)) {
        $last_name_error = 'Please insert your last name.';
        $errors = true;
    }
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

    if (!$errors) {
        $created = $user->create($name, $user_name, $email, $password, 0, $gas_station);

        if ($created) {
         
            echo '<script type="text/javascript">window.location = "index.php"</script>';
            exit();
        } else {
            $_SESSION['message']['type'] = 'danger';
            $_SESSION['message']['text'] = 'User is not created!';
            echo '<script type="text/javascript">window.location = "register.php"</script>';
            exit();
        }
    }
}

?>

<div class="container my-5 mx-auto">


    <div class="border border-secondary p-5 m-auto ">
        <h2>Register User</h2>
        <form action="" method='post'>
            First Name : <input type="text" class='form-control' name='name' value="<?php echo htmlspecialchars($name); ?>">
            <p class="text-danger" id="name-error">
                <?php echo isset($first_name_error) ? $first_name_error : ""; ?>
            </p><br>
            Last name : <input type="text" class='form-control' name='user_name' value="<?php echo htmlspecialchars($user_name); ?>">
            <p class="text-danger" id="name-error">
                <?php echo isset($last_name_error) ? $last_name_error : ""; ?>
            </p><br>
            Email : <input type="text" class='form-control' name='email' value="<?php echo htmlspecialchars($email); ?>">
            <p class="text-danger" id="name-error">
                <?php echo isset($email_error) ? $email_error : ""; ?>
            </p><br>
            Password : <input type="password" autocomplete class='form-control' name='password' value="<?php echo htmlspecialchars($password); ?>">
            <p class="text-danger" id="name-error">
                <?php echo isset($password_error) ? $password_error : ""; ?>
            </p><br>
            Gas Stations :
            <select required name="gas_station" class='form-select'>
                <!-- <option disabled selected>click to see traning plans</option> -->

                <?php
                $sql = "SELECT * FROM gas_stations";
                $run = $conn->query($sql);
                $results = $run->fetch_all(MYSQLI_ASSOC);

                foreach ($results as $result) {
                    echo "<option value='" . $result['id'] . "' >" . $result['name'] . "</option>";
                }


                ?>


            </select><br>

            <input type="submit" class='btn btn-primary mt-3' value='Register'>
        </form>

    </div>

</div>


<?php require_once "inc/footer.php"; ?>