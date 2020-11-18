<?php 
	require 'session.php';

	$rooms_info=array();

	if($conn){

		$sql_q1="SELECT * FROM rooms ORDER BY hostel_id";
		$result1=mysqli_query($conn,$sql_q1);
		$rooms=mysqli_fetch_all($result1,MYSQLI_ASSOC);

		$sql_q2="SELECT * FROM hostels";
		$result2=mysqli_query($conn,$sql_q2);
		$hostels=mysqli_fetch_all($result2,MYSQLI_ASSOC);

		foreach($hostels as $hostel){

			if(isset($_POST[$hostel['hostel_id']])){

				foreach ($rooms as $room){

					if($room['hostel_id']==$hostel['hostel_id']){
						$color='';
						if($room['isVacant']){
							$color='Green';
						}
						else if($room['isApplied']){
							$color='Blue';
						}
						else{
							$color='Red';
						}
						$to_push=array("room_id"=>$room['room_id'],"hostel_id"=>$room['hostel_id'],
							"color"=>$color);
						$rooms_info[]=$to_push;
					}

				}
				break;
			}
		}

		foreach($rooms as $room){

			if(isset($_POST['room'.$room['room_id'].'hostel'.$room['hostel_id']])){

				if($room['isVacant']){

					$sid=$student['student_id'];
					$hid=$room['hostel_id'];
					$rid=$room['room_id'];
					$sql_insert="INSERT INTO applications(student_id,hostel_id,room_id) 
					VALUES('$sid','$hid','$rid')";
					if(mysqli_query($conn,$sql_insert)){

						$sql_update_status="UPDATE rooms SET isVacant=0,isApplied=1 
						WHERE room_id='$rid' and hostel_id='$hid'";
						if(mysqli_query($conn,$sql_update_status)){
							$sql="SELECT * FROM hostels WHERE hostel_id='$hid'";
				      		$res=mysqli_query($conn,$sql);
				      		$hostels=mysqli_fetch_all($res,MYSQLI_ASSOC);
				      		$hostel=$hostels[0];
							$_SESSION['status']='You Have Applied For Room '.$rid.' of '.$hostel['hostel_name'];
							$sql="UPDATE students SET has_applied=1 WHERE student_id='$sid'";
							$res=mysqli_query($conn,$sql);
							header('Location: profile.php');
						}
					}

				}
				else{

					echo "<script>alert('You cannot apply for this room');</script>";
					break;
				}

			}

		}

	}


	mysqli_close($conn);
 ?>


<!DOCTYPE HTML>
<html>
	
	<style>
		#hostel_buttons{
			width: 100%;
			border-style: solid;
		}
	</style>

	<?php include('templates/header.php'); ?>
	<form action="apply.php" method="post" id="hostel_buttons">

		<?php foreach($hostels as $hostel){ ?>

			<div style=" margin-bottom:10px; padding-bottom:10px;" class="waves-effect waves-light btn-small brand-text">
			<h6>
				<input type="submit" value="<?php echo htmlspecialchars($hostel['hostel_name']); ?>" 
				name="<?php echo htmlspecialchars($hostel['hostel_id']); ?>"> 
			</h6>
			</div>
			

		<?php } ?>		

	</form>

	<div style="text-align: center;">
		<?php if(count($rooms_info)>0){ ?>

			<form action="apply.php" method="post">

				<?php foreach($rooms_info as $room){ ?>

					<label><?php echo 'Room '.$room['room_id']; ?></label>

					<button type="submit" class="btn brand z-depth-0" name="<?php echo 'room'.$room['room_id'].'hostel'.$room['hostel_id'];?>">
					</button>

				<?php } ?>

			</form>

		<?php } ?>
	</div>

	<?php include('templates/footer.php'); ?>
</html>
