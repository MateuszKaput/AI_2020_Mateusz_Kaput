<?php

session_start();

include_once('../includes/connection.php');
if (isset($_SESSION['logged_in'])) {
	if(isset($_POST['title'], $_POST['content'], $_POST['category'])){
		$title = $_POST['title'];
		$content = nl2br($_POST['content']);
		$category = $_POST['category'];
		
		if(empty($title) or empty($content) or empty($category)){
			$error = 'Wszystkie pola są wymagane';
		}else{
			$query = $pdo->prepare('INSERT INTO books (book_title, book_info, book_category) VALUES  (?, ?, ?)');
			
			$query->bindValue(1, $title);
			$query->bindValue(2, $content);
			$query->bindValue(3, $category);
			
			$query->execute();
			
			header('Location: add.php');
			
		}
	}
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
			
			<h4>Dodaj Książkę</h4>
			
			<?php 
					if (isset($error)){ ?>
						<small style="color:aa0000"><?php echo $error; ?></small>
						<br /><br />
			<?php } ?>
			
			<form action="add.php" method="post" autocomplete="off">
				<input type="text" name="title" placeholder="Tutuł" /><br /><br />
				<textarea rows="15" cols="50" name="content" placeholder="Opis książki"></textarea><br /><br />
				<select name="category">
					<option>Fikcja</option>
					<option>Akcja</option>
					<option>Inne</option>
				</select><br /><br />
				<input type="submit" value="Dodaj książkę">
			</form>
		</div>
		
		<div class="col-md-0"></div>
		
	</div>
	
</div>
</body>
</html>

<?php
}else {
	header('Location: index.php');
	
}

?>