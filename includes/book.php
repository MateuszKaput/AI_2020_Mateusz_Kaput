<?php

class Book {
	public function fetch_all(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM books");
		$query->execute();
		
		return $query->fetchAll();
	}
	
	public function fetch_data($book_id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM books WHERE book_id = ?");
		$query->bindValue(1, $book_id);
		$query->execute();
		
		return $query->fetch();
	}
}

?>