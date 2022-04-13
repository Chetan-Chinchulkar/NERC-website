<?php 
	session_start();
	include 'nercReg/dbconfig.php';

	$conn = connect();

	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(!empty($_POST['user'])){
			$username = $_POST['user'];
			$password = $_POST['pass'];

			$user = retrieveUserByEmail($conn, $username);

			if(sizeof($user)!==0){
				if(password_verify($password,$user[0]['password'])){
					$_SESSION['username'] = $username;

					if($username == "nerc@iitg.ac.in"){
						echo '
							<form method="post" action="displayAdm.php" id="disAdmForm">
							</form>
							<script>
								document.getElementById("disAdmForm").submit();
							</script>';	
					}else if($username == "abc@iitg.ac.in"){
						echo '
							<form method="post" action="displayAdm.php" id="disAdmForm">
							</form>
							<script>
								document.getElementById("disAdmForm").submit();
							</script>';	
					}else{
						echo '<script>alert("Coming Soon. Only admin can login now.");</script>';
					}
					
				}else{
					echo '<script>alert("wrong password or user doesnt exist");</script>';
				}
			}else{
				echo '<script>alert("User doesnt exist");</script>';
			}

		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login to NERC 2022</title>

		<style>
			body{
				margin: 0;
				color: #6a6f8c;
				background: #c8c8c8;
				font: 600 16px/18px 'Open Sans',sans-serif;
				height: 100vh;
				width: 100vw;
				display: flex;
				flex-direction: row;
				justify-content: center;
				align-items: center;
			}
			*,:after,:before{box-sizing:border-box}
			.clearfix:after,.clearfix:before{content:'';display:table}
			.clearfix:after{clear:both;display:block}
			a{color:inherit;text-decoration:none}

			.login-wrap{
				width:100%;
				margin:auto;
				max-width:525px;
				min-height:670px;
				position:relative;
				background:url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center;
				box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
			}
			.login-html{
				width:100%;
				height:100%;
				position:absolute;
				padding:90px 70px 50px 70px;
				background:rgba(40,57,101,.9);
			}
			.login-html .sign-in-htm,
			.login-html .sign-up-htm{
				top:0;
				left:0;
				right:0;
				bottom:0;
				position:absolute;
				transform:rotateY(180deg);
				backface-visibility:hidden;
				transition:all .4s linear;
			}
			.login-html .sign-in,
			.login-html .sign-up,
			.login-form .group .check{
				display:none;
			}
			.login-html .tab,
			.login-form .group .label,
			.login-form .group .button{
				text-transform:uppercase;
			}
			.login-html .tab{
				font-size:22px;
				margin-right:15px;
				padding-bottom:5px;
				margin:0 15px 10px 0;
				display:inline-block;
				border-bottom:2px solid transparent;
			}
			.login-html .sign-in:checked + .tab,
			.login-html .sign-up:checked + .tab{
				color:#fff;
				border-color:#1161ee;
			}
			.login-form{
				min-height:345px;
				position:relative;
				perspective:1000px;
				transform-style:preserve-3d;
			}
			.login-form .group{
				margin-bottom:15px;
			}
			.login-form .group .label,
			.login-form .group .input,
			.login-form .group .button{
				width:100%;
				color:#fff;
				display:block;
			}
			.login-form .group .input,
			.login-form .group .button{
				border:none;
				padding:15px 20px;
				border-radius:25px;
				background:rgba(255,255,255,.1);
			}
			.login-form .group input[data-type="password"]{
				text-security:circle;
				-webkit-text-security:circle;
			}
			.login-form .group .label{
				color:#aaa;
				font-size:12px;
			}
			.login-form .group .button{
				background:#1161ee;
			}
			.login-form .group label .icon{
				width:15px;
				height:15px;
				border-radius:2px;
				position:relative;
				display:inline-block;
				background:rgba(255,255,255,.1);
			}
			.login-form .group label .icon:before,
			.login-form .group label .icon:after{
				content:'';
				width:10px;
				height:2px;
				background:#fff;
				position:absolute;
				transition:all .2s ease-in-out 0s;
			}
			.login-form .group label .icon:before{
				left:3px;
				width:5px;
				bottom:6px;
				transform:scale(0) rotate(0);
			}
			.login-form .group label .icon:after{
				top:6px;
				right:0;
				transform:scale(0) rotate(0);
			}
			.login-form .group .check:checked + label{
				color:#fff;
			}
			.login-form .group .check:checked + label .icon{
				background:#1161ee;
			}
			.login-form .group .check:checked + label .icon:before{
				transform:scale(1) rotate(45deg);
			}
			.login-form .group .check:checked + label .icon:after{
				transform:scale(1) rotate(-45deg);
			}
			.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
				transform:rotate(0);
			}
			.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
				transform:rotate(0);
			}

			.hr{
				height:2px;
				margin:60px 0 50px 0;
				background:rgba(255,255,255,.2);
			}
			.foot-lnk{
				text-align:center;
			}

			.link-button{
      
		        padding: 24px 82px;
		        margin-top: 36px;
		        background-color: rgba(0,0,0,0);
		        color: #fff;
		        cursor: pointer;
		        text-decoration: none;
		        width: 100%;
				border: none;
				border-radius: 50px;
				background: rgba(255,255,255,.1);
		      
		      }

		      .link-button:hover{
		        
		        transition: all 0.5s ease-in;
		        text-decoration: none;
		        border: 1px solid #fff;
		        cursor: pointer;
				background: rgba(0,255,255,.1);
		      }

		      .button{
		      	cursor: pointer;
		      }
		</style>
	</head>
	<body>
		<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
			<div class="login-form">
				<div class="sign-in-htm">
					<form id="loginForm" method="post" action="login.php">
						<div class="group">
							<label for="user" class="label">Username</label>
							<input id="user" name="user" type="text" class="input">
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass" name="pass" type="password" class="input" data-type="password">
						</div>
						<div class="group">
							<input type="submit" name="submitBtn" id="submitBtn" class="button" value="Sign In">
						</div>
						<div class="hr"></div>
						<div class="foot-lnk">
							<a href="#forgot">Forgot Password?</a>
						</div>
					</form>
				</div>
				<div class="sign-up-htm">
					<div class="group">
						<form method="post" action="nercReg/index.php" class="inline">
				            <button type="submit" name="submit_param" value="submit_value" class="link-button">
				              Click to Continue Registration
				            </button>
				          </form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>
