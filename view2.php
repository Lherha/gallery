<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <style>
        .content {
            text-align: center;
        }
        p {
            color: red;
        }
        button {
            background-color: green;
            color: white;
            text-decoration: none;
            border: none; 
            padding: 10px 20px; 
            cursor: pointer; 
        }
        button a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<button class="login"><a href="login.php">Login</a></button>

<br><br><br>

<div class="content">
    <p>You are now logged out.</p>
    <br><br><br><br><br><br>

    <?php 
    echo "<h2>No images found.</h2>";
    ?>
</div>

</body>
</html>