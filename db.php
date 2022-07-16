<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

	$db = new mysqli("130.162.132.235","root","061221","nb-latex-pj");
	$db->set_charset("utf8");

	if($db -> connect_errno){
		echo "Failed to connect to MySQL: ".$db -> connect_error ;
		exit();
	}

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>