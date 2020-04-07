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




<div class="container" style="background-color:blue">
	<div class="row">
		<div class="col-4" style="background-color:orange">
			<ul class = "nav nav-pills nav-justified">
				<li><a href = "./index.html">Home</a></li>
				<li><a href = "#">Strona 1</a></li>
				<li><a href = "#">Strona 2</a></li>
				<li><a href = "#">Strona 3</a></li>
				<li><a href = "#">Strona 4</a></li>
				
			</ul>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-8" style="background-color:white">
		<ol>
		<?php foreach ($books as $book){ ?>
			<li>
				<a href="book.php?id=<?php echo $book['book_id']?>">
					<?php echo $book['book_title']?>
				</a>
				
				-<small><?php echo $book['book_category']?></small>
		
		
		<?php } ?>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

<div class="tab-content">
	<div class="tab-pane fade active in" id="home">...</div>
	<div class="tab-pane fade" id="profile">...</div>
	<div class="tab-pane fade" id="messages">...</div>
	<div class="tab-pane fade" id="settings">...</div>
</div>
</body>
</html>