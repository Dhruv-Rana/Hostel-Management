		
		<?php
		$sql="SELECT email FROM managers WHERE is_admin=1";
		$result=mysqli_query($conn,$sql);
		$admin_email_id=mysqli_fetch_assoc($result);
		?>
		</div>
	<footer class="section">
		<div class="left black-text" >
		Contact Admin:- 
		<form action="send_mail.php" method="POST" id="admin_email_form">
		<input type="hidden" name="receiver_email" value="<?php echo htmlspecialchars($admin_email_id['email'])?>">
		<button id="admin_email"><h6><?php echo htmlspecialchars($admin_email_id['email'])?></h6></button>
		</form>
		</div>
		<div class="center grey-text">All Rights Reserved.</div>
	</footer>
	</div>
</body>