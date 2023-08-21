<!DOCTYPE html>
<html>
<head>
	<title>PHP Image Gallery</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			background-color: #f0f5f9;
		}

		.container {
			background-color: #ffffff;
			border-radius: 8px;
			padding: 20px;
			box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
		}

		.error-message {
			color: #ff0000;
			margin-bottom: 10px;
		}

		form {
			display: flex;
			flex-direction: column;
			align-items: flex-start; 
		}

		input[type="file"],
		textarea,
		input[type="text"] {
			margin-bottom: 10px;
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
			width: 100%;
		}

		input[type="submit"] {
			background-color: #007bff;
			color: #ffffff;
			border: none;
			padding: 10px 20px;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #0056b3;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php if (isset($_GET['error'])): ?>
			<p class="error-message"><?php echo $_GET['error']; ?></p>
		<?php endif; ?>

		<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="my_image">
			
			<label for="image_description">Image Description:</label>
			<textarea id="image_description" name="image_description" rows="4" placeholder="Enter a description for the image"></textarea>

			<label for="image_details">Additional Details:</label>
			<input type="text" id="image_details" name="image_details" placeholder="Enter additional details">

			<input type="submit" name="submit" value="Upload">
		</form>
	</div>
	<p>Go back to &#x2192; <a href="view.php">Homepage</a></p>
</body>
</html>
