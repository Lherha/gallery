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
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 0;
            padding-bottom: 0;
        }
        .logout {
            text-align: right;
            font-size: 16px;
            background-color: red;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .search-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .search-form button{
            background-color: #2596be;
            color: white;
            margin-top: 5px;
        }
		.upload{
			text-align: left;
            font-size: 16px; 
            background-color: #e28743;
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
        .welcome a {
            text-align: center;
            color: green;
            margin-top: 20px;
        }
        .welcome a:hover {
            color: black;
        }
        .login{
            background-color: green;
            color: white;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="header">
    <?php if (isset($_SESSION['username'])) : ?>
        <h1 class="welcome"><a href="view.php"> Welcome <?php echo $_SESSION['username']; ?> </a></h1>
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
            <form class="search-form" method="get" action="search.php">
            <input type="text" name="query" placeholder="Search by details">
            <button type="submit">Search</button>
            </form>
	
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
                        <p>Description: ' . $images['description'] . '</p>
                        <p>Details: ' . $images['details'] . '</p>
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