<?php
	$erroreDB = "";
	try {
	  $db = new PDO("mysql:dbname=book_sharing;host=localhost;charset=utf8;", "root", "" );
	}
	catch (PDOException $ex) {
	  $erroreDB = $ex->getMessage();
	}
?>