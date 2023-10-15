<?php
	echo "<PRE>";
	try{
		$dbh = new pdo( 'mysql:host=127.0.0.1;dbname=resclaves',
		'slave_narratives',
		'nquQuNgjJGnUhwerMZRY',
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		printf ("Coucou\n");
		$sql = "SELECT id_auteur, nom, origine_parents FROM tab_auteurs ORDER BY id_auteur";
		//$sql = "SHOW TABLES";
		$sth = $dbh->query($sql);
		//$rows = $sth->fetchAll();
		//foreach ($rows as $row) {
		//    printf("$row[0] $row[1] $row[2]");
		//	$r = substr($row[2], strrpos($row[2], '-'));
		//	printf(" | $r\n");
		//}
	}
	catch(PDOException $ex){
		die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
	}
	echo "</PRE>";
?>