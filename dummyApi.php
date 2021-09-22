<?php
header('Content-type: application/json');
header('Acess-control-Allow-Origin:*');

$json = file_get_contents("https://jsonplaceholder.typicode.com/todos/1");
$arr = json_decode($json, true);

if ($arr['userId'] == 1 && $arr['id'] == 1) {
	echo $arr['userId'];
	echo $arr['id'];
}
 ?>

 hello