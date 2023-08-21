<?php
include "db_conn.php";
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$loggedIn = isset($_SESSION['username']);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery</title>
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
        .logout {
            text-align: right;
            font-size: 16px; 
            background-color: red;
            color: white;
        }
        .upload{
            text-align: left;
            font-size: 16px; 
            background-color: pink;
        }
        .gallery {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            min-height: 100vh;
        }
        .alb {
            width: 200px;
            height: 200px;
            padding: 5px;
        }
        .alb img {
            width: 100%;
            height: 100%;
        }
        a {
            text-decoration: none;
            color: black;
        }
        .welcome {
            text-align: center;
            color: green;
            margin-top: 20px;
        }
        .login{
            background-color: green;
            color: white;
            font-size: 16px;
            padding: 5px 10px;
            border: none;
        }
    </style>
</head>
<body>
<div class="header">
        <?php if ($loggedIn) : ?>
            <h1 class="welcome">Welcome <?php echo $_SESSION['username']; ?></h1>
            <form method="post" action="">
                <button class="logout" type="submit" name="logout">Logout</button>
            </form>
            <?php if (isset($_SESSION['logged_out'])) : ?>
                <p>You are now logged out.</p>
                <?php unset($_SESSION['logged_out']); ?>
            <?php endif; ?>
        <?php else : ?>
            <a class="login" href="login.php">Login</a>
        <?php endif; ?>
    </div>
	
    <?php if ($loggedIn) : ?>
        <button class="upload"><a href="index.php">&#8592; Upload</a></button>
    <?php endif; ?>

    <?php
    if ($loggedIn) {
        echo '<div class="gallery">';
        
        $sql = "SELECT * FROM images ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($images = mysqli_fetch_assoc($res)) {
                echo '<div class="alb">
                        <img src="uploads/' . $images['image_url'] . '" alt="Image">
                      </div>';
            }
        } else {
            echo "<p>No images found.</p>";
        }
        
        echo '</div>';
    }
    ?>
</body>
</html>