<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <meta http-equiv="refresh" content="3;url=view2.php">
    <style>
        p {
            color: red;
        }
    </style>
</head>
<body>
    <div>
        <p>You are now logged out.</p>
    </div>
</body>
</html>
