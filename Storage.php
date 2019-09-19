<?php
require_once('config.php');

//base interface of fabric product

interface Storage {
	public function add($cleaned_request);
}

//implementation for database type

class DatabaseStorage implements Storage {
	private $connection;

	public function __construct() {
		$dsn = "mysql:host=" . Config::HOST . ";dbname=" . Config::DB_NAME . ";charset=" . Config::CHARSET;
		$this->connection = new PDO($dsn, Config::USER, Config::PASSWORD, Config::PDO_OPT);
	}

	public function add($cleaned_request) {
		$query = "INSERT INTO " . Config::TABLE . " (name, phone, message)" . " VALUES(:name, :phone, :message)";
		$q = $this->connection->prepare($query)->execute($cleaned_request);
	}
}

// implementations for file types of storage

abstract class FileStorage implements Storage {
	protected $file_path;

	public function __construct($file_path) {
		$this->file_path = $file_path;
	}

}

class TxtStorage extends FileStorage {	

	public function add($cleaned_request) {
		$data = implode(Config::FILE_FIELD_SEP, $cleaned_request) . Config::FILE_LINE_SEP;

		if(! file_put_contents($this->file_path, $data, FILE_APPEND | LOCK_EX)) {
			throw new Exception("Error while putting data in the file", 1);
		}
	}
}

class CsvStorage extends FileStorage {
	
	public function add($cleaned_request) {
		$file = fopen($this->file_path, 'a');
		fputcsv($file, $cleaned_request);
		fclose($file);
	}
}

class JsonStorage extends FileStorage {

	public function add($cleaned_request) {
		$file_data = json_decode(file_get_contents($this->file_path, true));
		if($file_data == NULL) {
			$file_data = [];
		}
		array_push($file_data, $cleaned_request);
		file_put_contents($this->file_path, json_encode($file_data, JSON_PRETTY_PRINT));
	}
}
?>