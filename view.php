<?php
include "db_conn.php";
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: logout.php');
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
        .logout-btn {
            text-align: right;
            font-size: 16px; 
            background-color: red;
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
    </style>
</head>
<body>
    <div class="header">
        <h1 class="welcome">Welcome <?php echo $_SESSION['username']; ?></h1>
        <div class="logout-btn">
            <?php
            if (isset($_SESSION['username'])) {
                echo '<form method="post" action="logout.php">
                        <button type="submit" name="logout">Logout</button>
                      </form>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </div>
    </div>
	
    <button class="upload"><a href="index.php">&#8592;Upload</a></button>

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
