<!DOCTYPE html>
<?php include 'global.php';?>
<head>
	<link rel="stylesheet" type="text/css" href="./css/global.css">
</head>
<body>
	<?php
	include("header.php");
	?>
	<?php 
            $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $statement->bind_param("s", $_SESSION['profileuser3']);
            $statement->execute();
            $result = $statement->get_result();
            while($row = $result->fetch_assoc()) {
                if ($row['banned'] == '1') {
                    $banreason = $row['banreason'];
              } else {
				header('Location: index.php');
			  }
            }
            ?>
			<div>
				<center>
	<img src="banned.jpg" class="centeredimg"></div>
		</center>
	<br><div class="banned">
	<h1>You have been banned!</h1><br>Ban reason: <?php echo $banreason; ?><br><br>
		</p></div>
	<?php include("footer.php") ?>
</body>
<?php $mysqli->close();?>