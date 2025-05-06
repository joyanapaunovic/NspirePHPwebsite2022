<?php


require_once "config.php";
try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query){
    global $conn;
    return $conn->query($query)->fetchAll();
}

// function logActionOrError($message, $error = false){
	
// 	if($error){
// 		$file = fopen(dirname(__DIR__, 1) . '/data/error.txt', "a+");
// 	} else {
// 		$file = fopen(dirname(__DIR__, 1) . '/data/log.txt', "a+");
// 	}
	
// 	$korisnik = $_SESSION["user"]["username"];
// 	$ip = $_SERVER['REMOTE_ADDR'];
// 	$datum = date('Y-m-d H:i:s');
	
	
// 	$upis = "$korisnik \t $ip \t $datum \t $message \n";
// 	fwrite($file, $upis);
// 	fclose($file);
// }
