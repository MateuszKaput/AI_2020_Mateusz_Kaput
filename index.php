<?php

include_once('includes/connection.php');
include_once('includes/book.php');

$book = new Book;
$books = $book->fetch_all();
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
				<li><a href = "./index.php">Strona główna</a></li>
				<li><a href = "./admin">Logowanie</a></li>
			</ul>
		</div>
		<div class="col-md-0"></div>
		<div class="col-md-12" style="background-color:white">
		<h3> Zapraszamy do zapoznania się z naszą kolekcją książek!</h3>
		<ol>
		<?php foreach ($books as $book){ ?>
			<li>
				<a href="book.php?id=<?php echo $book['book_id']?>">
					<?php echo $book['book_title']?>
				</a>
				-<small><?php echo $book['book_category']?></small>
			</li>
		<?php } ?>
		</div>
		<div class="col-md-0"></div>
	</div>
</div>
</body>
</html>