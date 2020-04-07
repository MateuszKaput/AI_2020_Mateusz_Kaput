<?php 

include_once('includes/connection.php');
include_once('includes/book.php');

$book = new Book;

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$data = $book->fetch_data($id);
	
	?>
		
		
		
		
	<?php
	print_r($data);
} else{
	header('Location: index.php');
	exit();
}

?>