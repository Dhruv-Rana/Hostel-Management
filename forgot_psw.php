<?php 
	
	require 'config/db_connect.php';

	function generate_random_password() { 
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	  
	    for ($i = 0; $i < 10; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	  
	    return $randomString; 
	} 

	if(isset($_POST['submit'])){

		$to=$_POST['email'];

		$sql="SELECT * FROM STUDENTS WHERE email='$to'";
		$res=mysqli_query($conn,$sql);

		if(mysqli_num_rows($res)>0){

			require_once('PHPMailer/PHPMailerAutoload.php');

			$from='ddjhms@gmail.com';
			$password='ddjhmspassword';
			$sub='New Password';
			$new_password=generate_random_password();
			$body='Login With This Password: '.$new_password;
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'ssl';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = '465';
			$mail->isHTML();
			$mail->Username = $from;
			$mail->Password = $password;
			$mail->Subject = $sub;
			$mail->Body = $body;
			$mail->AddAddress($to);

			if($mail->Send()){

				$sql="UPDATE STUDENTS SET password='$new_password' WHERE email='$to'";
				$res=mysqli_query($conn,$sql);
				mysqli_close($conn);
				header('Location: index.php');
			}
		}
		else{
			$sql="SELECT * FROM MANAGERS WHERE email='$to'";
			$res=mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)>0){
				require_once('PHPMailer/PHPMailerAutoload.php');

				$from='ddjhms@gmail.com';
				$password='ddjhmspassword';
				$sub='New Password';
				$new_password=generate_random_password();
				$body='Login With This Password: '.$new_password;
				$mail = new PHPMailer();
				$mail->isSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = '465';
				$mail->isHTML();
				$mail->Username = $from;
				$mail->Password = $password;
				$mail->Subject = $sub;
				$mail->Body = $body;
				$mail->AddAddress($to);

				if($mail->Send()){
					$sql="UPDATE MANAGERS SET password='$new_password' WHERE email='$to'";
					$res=mysqli_query($conn,$sql);
					mysqli_close($conn);
					header('Location: manager-adminLogin.php');
				}
			}
			else{
				$message="Please enter a valid email";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
</head>
<body>

	<center>

		<h2>A New Password will be sent to your email</h2>
		<br>
		<h2>Using it, you can login to your account and may change the password if you wish to</h2>
		<br>

		<form action="forgot_psw.php" method="POST">

			<label>Email:</label>
			<input type="email" name="email">
			<br><br>

			<input type="submit" name="submit" value="Submit">

		</form>



	</center>

</body>
</html>