<?php
	require 'session.php';
?>


<!DOCTYPE HTML>
<html>
	<?php include('templates/header.php'); ?>

	<div class="z-depth-0 center">
			<h3><?php echo htmlspecialchars($student['first_name']);echo(" ");echo htmlspecialchars($student['last_name']);?></h3>
			<h5><?php echo htmlspecialchars($_SESSION['status']);?></h5>
			<h6><?php echo htmlspecialchars($student['mobile'])?></h6>
			<h6><?php echo htmlspecialchars($student['email'])?></h6>
			<h6><?php echo '<img alt="no image" height="400" width="800" src="data:image;base64,'.$student['id_card'].'">' ?></h6>
	</div>
	<div class="center">
		<a href="../logout.php"><button type="submit" name="logout" class="btn brand z-depth-0">Log Out</button></a>
	</div>

	<?php include('templates/footer.php'); ?>
</html>
