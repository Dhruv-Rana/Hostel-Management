<head>
	<title>HMS</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style type="text/css">
		.main_container{
			position:relative;
			min-height:100vh;
		}
		.content_wrap{
			padding-bottom:4.0rem;
		}
		.brand{
			background: #cbb09c !important;
		}
		.brand-text{
			color: #cbb09c !important;
			font-size: 40px !important;
		}
		.title-text{
			font-size: 25px;
			text-align: center;
		}
		.title-box{
			margin: 0px 25px;
		}
		form{
			max-width: 460px;
			margin: 20px auto;
			padding: 20px;
		}
		table,tr,td{
			border:1px solid black;
			text-align: center;
		}
		footer{
			position: absolute;
			bottom: 0;
			width: 100%;
			height:3.0rem;
			background-color: #ffff99;
			color: white;
			text-align: center;
		}
		#manager_email{
			padding:0;
			margin:0;
			text-decoration:underline;
			display:inline;
			color:blue;
			border:none;
			background:none;
		}
		button:hover{
			cursor:pointer;
		}
		#admin_email{
			padding:0;
			margin:0;
			border:none;
			background:none;
			text-decoration:underline;
			display:inline;
			color:blue;
		}
		#admin_email_form{
			margin:0;
			padding:0;
			width:auto;
			display:inline;
		}
	</style>
</head>
<body class="grey lighten-2">
<div class="main_container">
	<div class="content_wrap">
		<nav class="white z-depth-0">
			<div class="container row">
				<a href="index.php" class="brand-logo green-text">HOSTEL MANAGEMENT SYSTEM</a>
				<div class="col s1 push-s7 title-box">
					<span class="flow-text blue-text"><a href="http://localhost/HMS/admins/index.php" class="blue-text text-darken-3 z-depth-0 title-text">Home</a></span>
				</div>
				<div class="col s1 push-s7 title-box">
					<span class="flow-text blue-text"><a href="http://localhost/HMS/admins/hostels.php" class="blue-text text-darken-3 z-depth-0 title-text">Hostels</a></span>
				</div>
				<div class="col s1 push-s7 title-box">
					<span class="flow-text blue-text"><a href="http://localhost/HMS/admins/students.php" class="blue-text text-darken-3 z-depth-0 title-text">Students</a></span>
				</div>
				<div class="col s1 push-s7 title-box">
					<span class="flow-text blue-text"><a href="http://localhost/HMS/admins/profile.php" class="blue-text text-darken-3 z-depth-0 title-text">Profile</a></span>
				</div>
			</div>
		</nav>