<?php
require_once('Saver.php');
$request = ['name' => 'dima', 'email' => 'dima@mail.com',
	'message' => 'hello, dima, hello, hello, dima!!!!!!!!!!'];


SaverFactory::getSaver('database')->setPath('bob1/data/file.txt')->save($request);
?>