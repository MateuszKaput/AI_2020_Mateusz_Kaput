<?php
include_once('../includes/connection.php');
include_once('./user.php');

$user = new User;
$users = $user->fetch_all();

if(isset($_POST['username'], $_POST['password'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		if(empty($username) or empty($password)){
			$error = 'Wszystkie pola są wymagane';
		}else{
			$exist = 'false';
			foreach($users as $user){
				if($username==$user['user_name']){
					$error = 'Nazwa użytkownika jest zajęta';
					$exist = 'true';
					break;
				}
			}
			if($exist=='false'){
				$query = $pdo->prepare('INSERT INTO users (user_name, user_password) VALUES  (?, ?)');
			
				$query->bindValue(1, $username);
				$query->bindValue(2, $password);
				
				$query->execute();
				
				$done = 'Konto zostało dodane';
			}
		}
	}
?>

<html>
	<head>
	<title>Logowanie do Księgarni</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	</head>
	<body>
		<div class="container">
		<div>
		<center>
			<h1>Załóż konto totalnie za darmo!</h1>
		</center>
		</div>
			<div class="col-md-3"></div>
			<div class="col-md-6" style="padding-top:50px;">
			<?php 
				if (isset($error)){ ?>
					<small style="color:aa0000"><?php echo $error; ?></small>
				<?php } ?>
			<?php 
				if (isset($done)){ ?>
					<small style="color:00aa00"><?php echo $done; ?></small>
				<?php } ?>
				<form action="createuser.php" method="post" autocomplete="off">
					<input type="text" name="username" placeholder="Login"/>
					<input type="password" name="password" placeholder="Hasło"/>
					<input type="submit" value="Załóż konto"/>
				</form>
				<button type="button" class="btn btn-default" aria-label="Left Align">
				<a href="../admin/index.php" style="text-decoration:none"><span class="glyphicon glyphicon-menu-left" aria-hidden="true">Powrót</span></a>
				</button>
			</div>
			<div class="col-md-3"></div>
		</div>
	</body>
	</html>