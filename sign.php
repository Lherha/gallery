<?php
require 'db_conn.php';

$success = false;
$userExists = false;
$passwordMismatch = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required.";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $errors[] = "Only letters and white space allowed for Username.";
        }
    }

    // Validate password strength
    if (empty($password)) {
        $errors[] = "Password is required.";
    } else {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        }
    }

    if ($password !== $cpassword) {
        $passwordMismatch = true;
    }

    if (empty($errors) && !$passwordMismatch) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM `registration` WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $userExists = true;
            } else {
                $sql = "INSERT INTO `registration` (username, password) VALUES ('$username', '$hashedPassword')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = true;
                    header('location: login.php');
                    exit;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center">Sign up page</h1>
    <div class="container mt-5">
        <?php if ($userExists): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Ohh no sorry</strong> User already exists.
            </div>
        <?php endif; ?>

        <?php if ($passwordMismatch): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Ohh no sorry</strong> Passwords didn't match.
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <strong>Success</strong> You are successfully signed up.
            </div>
        <?php endif; ?>

        <form action="sign.php" method="post">
            <div class="form-group">
                <label for="username">Name</label>
                <input type="text" class="form-control" placeholder="Enter your username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm password" name="cpassword" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign up</button>
        </form>
        <br> or already have an account?
        <button onclick="window.location.href = 'login.php';">Login</button>                                        

        </div>
        <p style="padding-left: 10px; padding-top: 20px;">
        Go back to <a href="view2.php">Homepage</a>
        </p>
</body>
</html>
