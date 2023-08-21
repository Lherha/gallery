<?php
include "db_conn.php";
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: ' . $_SERVER['PHP_SELF']);
    exit;
}
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
            width: 70px;
        }
    </style>
</head>
<body>
    <div class="header">
    <?php if (isset($_SESSION['username'])) : ?>
            <h1 class="welcome">Welcome <?php echo $_SESSION['username']; ?></h1>
        <?php endif; ?>
        <div class="logout-btn">
            <?php if (isset($_SESSION['username'])) : ?>
                <form method="post" action="logout.php">
                    <button class="logout" type="submit" name="logout">Logout</button>
                </form>
            <?php else : ?>
                <a class="login" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
	
    <?php if (isset($_SESSION['username'])) : ?>
        <button class="upload"><a href="index.php">&#8592;Upload</a></button>
    <?php endif; ?>

    <?php
    if (isset($_SESSION['username'])) {
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
            echo "No images found.";
        }
        
        echo '</div>';
    }
    ?>
</body>
</html>