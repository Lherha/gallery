<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        /* Add any desired styles here */
    </style>
    <script>
        setTimeout(function () {
            window.location.href = "view.php";
        }, 2000);
    </script>
</head>
<body>
    <div>
        <p>You are now logged out.</p>
    </div>
</body>
</html>
