
<?php 

if(isset($_POST['submit']))
{
    require_once('../PHPMailer/PHPMailerAutoload.php');
    $from=$_POST['send'];
    $password=$_POST['password'];
    $to=$_POST['receive'];
    $cc=$_POST['cc'];
    $bcc=$_POST['bcc'];
    $sub=$_POST['sub'];
    $body=$_POST['body'];

    $headers="From: ".$from."\r\n";


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
$mail->AddBCC($bcc);
$mail->AddCC($cc);

    if($mail->Send()){
//echo "<h2>Email sent successfully!!!</h2>";
echo "<script>var r=confirm('Email sent successfully!')
if(r==true)
location.replace('hostels.php');
else
location.replace('hostels.php');
</script>";

//header("location: hostels.php");

}
else 
{
    $_POST['receiver_email']=$to;
    echo "<h2>There was an error, Please try again!!!</h2>";
}

}

?>
<!DOCTYPE html>
<html>
<head>
<title>Send Email using PHP</title>
</head>
<body>
<table>
<form action="send_mail.php" method="post">
<tr>
<td>	<label>Sender:</label>	</td>
<td>	<input type="email" name="send" value="<?php echo htmlspecialchars($_COOKIE['user_email'])?>"></td>
</tr>
<tr>
<td><label>Sender Password:</label><br></td>
<td><input type="password" name="password"></td>
</tr>
<tr>
<td>		<label>Receiver:</label> </td>
<td>		<input type="email" name="receive" value="<?php echo htmlspecialchars($_POST['receiver_email'])?>"> </td>
</tr>
<tr>
<td>		<label>CC:</label></td>
<td>		<input type="email" name="cc"></td>
</tr>
<tr>
<td>		<label>BCC:</label></td>
<td>		<input type="email" name="bcc">	</td>
</tr>
<tr>
<td>		<label>Subject:</label></td>
<td>		<input type="text" name="sub"></td>
</tr>
<tr>
<td>		<label>Content:</label></td>
<td>		<input type="text" name="body"></td>
</tr>
<tr>
<td>		<input type="submit" name="submit"></td>
</tr>
</form>
</table>
</body>
</html>