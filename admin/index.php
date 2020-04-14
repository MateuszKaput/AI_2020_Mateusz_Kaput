<?php

include_once('../includes/connection.php');
include_once('../includes/book.php');

$book = new Book;
$books = $book->fetch_all();

session_start();

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
				<li><a href = "./index.php">Powrót na stronę główną</a></li>
				<li><a href = "./add.php">Dodaj książkę</a></li>
				<li><a href = "./delete.php">Usuń książkę</a></li>
				<li><a href = "./logout.php">Wyloguj</a></li>
			</ul>
		</div>
		<div class="col-md-0"></div>
		<div class="col-md-12" style="background-color:white">
		<h3> Witaj na stronie administracyjnej!</h3>
		<h4> Tutaj możesz dodawać oraz usuwać książki z bazy danych</h4>
		</div>
		<div class="col-md-0"></div>
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
					<input type="text" name="username" placeholder="Login"/>
					<input type="password" name="password" placeholder="Hasło"/>
					<input type="submit" value="Login"/>
				</form>
				<small><a href="createuser.php" style="text-decoration:none">Nie masz konta?</a> </small><br/><br/>
				<button type="button" class="btn btn-default" aria-label="Left Align">
				<a href="../index.php" style="text-decoration:none"><span class="glyphicon glyphicon-menu-left" aria-hidden="true">Powrót</span></a>
				</button>
			</div>
			<div class="col-md-3"></div>
		</div>
	</body>
	</html>
	<?php
}
?>