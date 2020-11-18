<?php 
	session_start();

	require 'config/db_connect.php';

	$error='';
	if(isset($_POST['login']))
	{
	  $email=$_POST['email'];
	  $psw=$_POST['password'];

	  if($conn)
	  {
	    $sql="SELECT * FROM students WHERE email='$email' AND password='$psw'";

	    $result=mysqli_query($conn,$sql);
	    $students=mysqli_fetch_all($result,MYSQLI_ASSOC);
	    if(mysqli_num_rows($result)>0)
	    {
	    	$student=$students[0];
	      $_SESSION['username'] = $email;
		  // cookie is here
		  setcookie("user_email",$student['email'],time()+60*60*24,'/');
	      if($student['hostel_id']!=NULL){
	      		$hid=$student['hostel_id'];
	      		$sid=$student['student_id'];

	      		$sql="SELECT * FROM hostels WHERE hostel_id='$hid'";
	      		$res=mysqli_query($conn,$sql);
	      		$hostels=mysqli_fetch_all($res,MYSQLI_ASSOC);
	      		$hostel=$hostels[0];

	      		$sql="SELECT * FROM rooms WHERE student_id='$sid'";
	      		$res=mysqli_query($conn,$sql);
	      		$rooms=mysqli_fetch_all($res,MYSQLI_ASSOC);
	      		$rid=$rooms[0]['room_id'];

	      		$_SESSION['status']='Currently Staying At '.$hostel['hostel_name'].' In Room '.$rid;
	      }
	      else{
	      	  $sid=$student['student_id'];
		      if($student['hostel_id']==NULL and $student['has_applied']==false){
		      	$_SESSION['status']='Not Hostelite And Not Yet Applied';
		      }
		      else{

		      	$sql="SELECT * FROM applications WHERE student_id='$sid'";
		      	$res=mysqli_query($conn,$sql);
		      	$applications=mysqli_fetch_all($res,MYSQLI_ASSOC);
		      	$application=$applications[0];

		      	$hid=$application['hostel_id'];
		      	$rid=$application['room_id'];

		      	$_SESSION['status']='You Have Applied For Room '.$rid.' of Hostel '.$hid;	
		      }
	  	  }
	      header("location: students/profile.php");
	    }
	    else
	    {
	      $error="*Incorrect username or password";
	    }
	  }
	  mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<section class="container grey-text">	
	<h4 class="center blue-text">Student Login</h4>
 
    <form class="white" action="index.php" method="POST">

        <label><h5>Email : </h5></label>
  	    <input type="email" name="email" >

        <label><h5>Password :</h5></label>
        <input type="password" name="password">
        <div class="red-text"><?php echo $error; ?></div>
      

      <div class="left">
        <input type="submit" class="btn brand z-depth-0" name="login" value="Login">
      </div>
<br><br>
      <h6>
      <span style="margin-left:120px;"> Don't have an account yet?
      <a href="http://localhost/HMS/student_signup.php" class="btn brand z-depth-0">Signup</a>
      </span>
    </h6>
    </form>

    

  </section>

   
  <h5 style="text-align: center;">
  Not a student? Click <a href="http://localhost/HMS/manager-adminLogin.php" class="blue-text text-darken-2 z-depth-0">HERE</a> to login 
  </h5>

  <center>
  	
  	<a href="http://localhost/HMS/forgot_psw.php"><u>Forgot Password</u></a>

  </center>

  <?php include('templates/footer.php'); ?>
</html>
