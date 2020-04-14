<?php 

include_once('includes/connection.php');
include_once('includes/book.php');

$book = new Book;

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$data = $book->fetch_data($id);
	
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
				<li><a href = "./index.php">Powrót</a></li>
				
			</ul>
		</div>
		
		<div class="col-md-0"></div>
		
		<div class="col-md-12" style="background-color:white">
		<h3>Tytuł: <?php echo $data['book_title'] ?> </h3>
		<small>Kategoria: <?php echo $data['book_category'] ?> </small><br /><br />
		<p>
			<?php echo $data['book_info'] ?>
		</p>
		</div>
		
		<div class="col-md-0"></div>
	</div>
</div>
</body>
</html>	
		
	<?php
} else{
	header('Location: index.php');
	exit();
}

?>