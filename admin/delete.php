<?php

session_start();

include_once('../includes/connection.php');
include_once('../includes/book.php');

$book = new Book;

if (isset($_SESSION['logged_in'])) {
	if (isset($_GET['id'])){
		$id = $_GET['id'];
		
		$query = $pdo->prepare('DELETE FROM books WHERE book_id = ?');
		$query->bindValue(1, $id);
		$query->execute();
		
		header('Location: delete.php');
	}
	
	
	$books = $book->fetch_all();
	//wyświetla stronę do usuwania książki
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
		
		<h4>Wybierz książkę do usunięcia</h4>
			<form action="delete.php" method="get">
				<select name="id">
					<?php foreach($books as $book){ ?>
						<option value=" <?php echo $book['book_id'];?> "> <?php echo $book['book_title']; ?> </option>
					<?php } ?>
				</select><br /><br />
				<input type="submit" value="Usuń książkę">
			</form>
		</div>
		
		<div class="col-md-0"></div>
	</div>
</div>
</body>
</html>	
	
	<?php
	
}else{
	header('Location: index.php');
}

?>