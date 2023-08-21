<?php
include "db_conn.php";
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

if (isset($_SESSION['username'])) {
    $sql = "SELECT * FROM images WHERE details LIKE ? ORDER BY id DESC";
    $stmt = mysqli_prepare($conn, $sql);
    $searchPattern = "%" . $searchQuery . "%";
    mysqli_stmt_bind_param($stmt, "s", $searchPattern);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
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
<div class="search-form">
    <form method="get" action="search.php">
        <input type="text" name="query" placeholder="Search by details" value="<?php echo htmlentities($searchQuery); ?>">
        <button type="submit">Search</button>
    </form>
</div>
<div class="gallery">
    <?php if (isset($_SESSION['username']) && mysqli_num_rows($res) > 0) : ?>
        <?php while ($images = mysqli_fetch_assoc($res)) : ?>
            <div class="alb">
                <img src="uploads/<?php echo $images['image_url']; ?>" alt="Image">
                <p>Description: <?php echo htmlentities($images['description']); ?></p>
                <p>Details: <?php echo htmlentities($images['details']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No images found.</p>
    <?php endif; ?>
</div>
</body>
</html>
