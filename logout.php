<?php
	session_start();
	setcookie("user_email","",time()-3600,"/");
	if(session_destroy())
	{
	header("Location: index.php");
	}
?>
