<?php

session_start();

include_once('../includes/connection.php');
if (isset($_SESSION['logged_in'])) {
	//strona po zalogowaniu
}else {
	header('Location: index.php');
	
}

?>