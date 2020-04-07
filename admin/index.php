<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
	//strona po zalogowaniu
	?>
	<html>
<head>
<Title>xXx</Title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body style="background-color:grey">
<div class="container">
	<div class="row">
		<div class="col-4" style="background-color:orange">
			<ul class = "nav nav-pills nav-justified">
				<li><a href = "./index.php">Home</a></li>
				<li><a href = "#">Dodaj książkę</a></li>
				<li><a href = "#">Spal książkę</a></li>
				<li><a href = "/admin">Wyloguj</a></li>
			</ul>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-8">
		
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
</body>
</html>

<?php
} else{
	//strona logowania
	if (isset($_POST['username'], $_POST['password'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		if (empty($username) or empty($password)){
			$error = 'Wszystkie pola są wymagane';
		} else{
			$query = $pdo->prepare("SELECT *FROM users WHERE user_name = ? AND user_password = ?");
			
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);
			
			$query->execute();
			
			$num = $query->rowCount();
			
			if($num == 1){
				//użytkownik znaleziony
				$_SESSION['logged_in'] = true;
				header('Location: index.php');
				exit();
			} else{
				//błąd logowania
				$error = 'Nieprawidłowe dane logowania!';
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
			<h1>Zaloguj się aby mieć dostęp do edycji księgozbioru</h1>
		</center>
		</div>
			<div class="col-md-3"></div>
			<div class="col-md-6" style="padding-top:50px;">
			<?php 
				if (isset($error)){ ?>
					<small style="color:aa0000"><?php echo $error; ?></small>
				<?php } ?>
				<form action="index.php" method="post" autocomplete="off">
					<input type="text" name="username" placeholder="Username"/>
					<input type="password" name="password" placeholder="Password"/>
					<input type="submit" value="Login"/>
				</form>
			</div>
			<div class="col-md-3"></div>
		</div>
	</body>
	</html>
	<?php
}
?>