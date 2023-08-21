<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <div>
        <p>You are now logged out.</p>
    </div>
    <meta http-equiv="refresh" content="3;url=<?php echo $_SERVER['HTTP_REFERER']; ?>">
</body>
</html>
