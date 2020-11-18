<?php 
	session_start();

	require 'config/db_connect.php';

	$errors=array('id_card'=>'','fname'=>'','lname'=>'','password'=>'','cpassword'=>'','email'=>'','phone'=>'','dob'=>'');

	if(isset($_POST['signup']))
	{
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$dob=$_POST['DOB'];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];


		$valid=true;

		//Validate first name

		if(strlen($fname)==0)
		{
			$errors['fname']="*First Name can't be empty";
			$valid=false;
		}
		else
		{
			for($i=0;$i<strlen($fname);$i++)
			{
				if(!ctype_alpha($fname[$i]))
				{
					$errors['fname']='*First Name can contain only alphabets';
					$valid=false;
					break;
				}
			}
		}

		//Validate last name

		if(strlen($lname)==0)
		{
			$errors['lname']="*Last Name can't be empty";
			$valid=false;
		}
		else
		{
			for($i=0;$i<strlen($lname);$i++) 
			{
				if(!ctype_alpha($lname[$i]))
				{
					$errors['lname']='*Last Name can contain only alphabets';
					$valid=false;
					break;
				}
			}
		}

		$temp_file_name=addslashes($_FILES['id_card']['tmp_name']);
		$file_name=addslashes($_FILES['id_card']['name']);
		$image=file_get_contents($temp_file_name);
		$image=base64_encode($image);

		//Validate Email

		$sql="SELECT * FROM students WHERE email='$email'";
		if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
			$errors['email']='An account with this email id already exists';
			$valid=false;
		}

		//Validate phone

		if(strlen($phone)==0)
		{
			$errors['phone']="*Phone number can't be empty";
			$valid=false;
		}
		else if(strlen($phone)!=10)
		{
			$errors['phone']="*Invalid phone number";
			$valid=false;
		}
		else
		{
			for($i=0;$i<strlen($phone);$i++)
			{
				if(!ctype_digit($phone[$i]))
				{
					$errors['phone']="*Invalid phone number";
					$valid=false;
					break;
				}
			}
		}


		//Validate password/confirm password

		if(strlen($password)==0)
		{
			$errors['password']="*Password can't be empty";
			$valid=false;
		}
		else
		{
			if($password!=$cpassword)
			{
				$errors['cpassword']='*Passwords do not match';
				$valid=false;
			}
		}

		//If everything is valid

		if($valid)
		{

			if($conn)
			{
				$sql="INSERT INTO students
				(first_name,last_name,date_of_birth,mobile,email,password,id_card) 
				VALUES
				('$fname','$lname','$dob','$phone','$email','$password','$image')";
				if(mysqli_query($conn,$sql)) 
				{
					$_SESSION['username'] = $email;
					$_SESSION['status']='Not Hostelite And Not Yet Applied';
					setcookie("user_email",$email,time()+60*60*24,'/');
					header("location: Students/profile.php");
				} 
			}

			mysqli_close($conn);
		}
	}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

	<section class="container grey-text">	
	<h4 class="center blue-text">Student SignUp Page</h4>
	<form class="white" action="student_signup.php" method="post" enctype="multipart/form-data">
    
        <label><h5>First Name: </h5></label>
        <input type="text" name="fname" value="<?php echo isset($_POST["fname"]) ? $_POST["fname"] : ''; ?>">
        <div class="red-text"><?php echo $errors['fname']; ?></div>
      
        <label><h5>Last Name: </h5></label>
        <input type="text" name="lname" value="<?php echo isset($_POST["lname"]) ? $_POST["lname"] : ''; ?>">
        <div class="red-text"><?php echo $errors['lname']; ?></div>

        <label><h5>ID Card: </h5></label>
        <input type="file" name="id_card" required> 
        <div class="red-text"><?php echo $errors['id_card']; ?></div><br>

      	<label><h5>Date of Birth: </h5></label>
        <input type="date" name="DOB" value="<?php echo isset($_POST["DOB"]) ? $_POST["DOB"] : ''; ?>">
	    <div class="red-text"><?php echo $errors['dob']; ?></div>

      	<label><h5>Email: </h5></label>
      	<input type="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"]: ''; ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>

      	<label><h5>Phone: </h5></label>
      	<input type="text" name="phone" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"]: '';?>">
        <div class="red-text"><?php echo $errors['phone']; ?></div>

        <label><h5>Password: </h5></label>
        <input type="password" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>">
        <div class="red-text"><?php echo $errors['password']; ?></div>

      	<label><h5>Confirm Password: </h5></label>
      	<input type="password" name="cpassword" value="<?php echo isset($_POST["cpassword"]) ? $_POST["cpassword"] : ''; ?>">
        <div class="red-text"><?php echo $errors['cpassword']; ?></div>

      <div class="center">
        <input type="submit" name="signup" value="Create" class="btn brand z-depth-0">
      </div>

    </form>
</section>

<?php include('templates/footer.php'); ?>
</html>
