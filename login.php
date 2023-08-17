<?php
require 'db_conn.php';

$loginFailed = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `registration` WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $userRow = mysqli_fetch_assoc($result);
        if (password_verify($password, $userRow['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: display.php');
            exit;
        } else {
            $loginFailed = true;
        }
    } else {
        $loginFailed = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center">Login Page</h1>
    <div class="container mt-5">
        <?php if ($loginFailed): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Login Failed:</strong> Incorrect username or password.
            </div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Enter your username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
