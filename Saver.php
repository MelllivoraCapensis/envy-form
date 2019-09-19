<?php 
require_once('config.php');
require_once('Storage.php');
require_once('ValidationException.php');

// abstract fabric

abstract class SaverFactory {

	const STORAGE_TYPES = [
		'database',
		'txt',
		'csv',
		'json',
	];

	// generate product instance - interface Storage

	abstract function getStorage(): Storage;

	// generate concrete fabric depending of storage type

	static public function getSaver($storage_type): SaverFactory {
		if(! in_array('database', self::STORAGE_TYPES)) {
			throw new Exception("There is not such storage type - <<<" . $storage_type . ">>>");	
		}

		$saver_class_name = ucfirst($storage_type) . 'Saver';

		return new $saver_class_name();	
	}

	abstract public function setPath($file_path);

	// create file with dirs if it doesnot exist

	static public function createFileIfNotExist($file_path) {

		if(file_exists(Config::DATAFILE_BASE_DIR . $file_path)) {
			return;
		}
		$path_arr = explode('/', $file_path);
		$folder_name = dirname($file_path);
		$file_name = end($path_arr);
		if(! file_exists(Config::DATAFILE_BASE_DIR . $folder_name)) {
			mkdir(Config::DATAFILE_BASE_DIR . $folder_name, 0777, true);
		}
		
		touch(Config::DATAFILE_BASE_DIR . $folder_name . '/' . $file_name);
	}

	// validate and return clean data or throw validate exception

	public function getCleanedRequest($request): array {

		$REQUIRED_MASKS = ['name' => '/^[\w\-]+$/i', 
			'phone' => '/^\+7-\d{3}-\d{3}-\d{2}-\d{2}$/', 
			'message' => "/^.{20,200}$/"];

		$cleaned_request = [];

		foreach ($REQUIRED_MASKS as $key => $mask) {

			if(! isset($request[$key])) {
				throw new ValidationException($key, 'Not valid ' . $key);
			}

			$value = strip_tags($request[$key]);

			if(! preg_match($mask, $value)) {
				throw new ValidationException($key, 'Not valid ' . $key);
			}

			$cleaned_request[$key] = $value;
		}

		return $cleaned_request;

	}

	// save data to any allowed storage

	public function save($request): void {
		$cleaned_request = $this->getCleanedRequest($request);
		$this->getStorage()->add($cleaned_request);
	}
}

// concrete fabric for database storage

class DatabaseSaver extends SaverFactory {

	public function getStorage(): Storage {
		return new DatabaseStorage();
	}

	// it doesnot need to specify filepath

	public function setPath($file_path = NULL) {		
		return $this;
	}
}

// helping abstract class for implementation setPath method

abstract class FileSaver extends SaverFactory {
	protected $file_path;

	public function setPath($file_path) {
		self::createFileIfNotExist($file_path);
		$this->file_path = Config::DATAFILE_BASE_DIR . $file_path;
		return $this;
	}	
}

class TxtSaver extends FileSaver {

	// sets default file path for storage

	public function __construct() {
		$this->setPath('txt/requests.txt');
	}

	// genereates implementation of Storage interface - TxtStorage

	public function getStorage(): Storage {
		return new TxtStorage($this->file_path);
	}
}

class CsvSaver extends FileSaver {

	public function __construct() {
		$this->setPath('csv/requests.csv');
	}


	public function getStorage(): Storage {
		return new CsvStorage($this->file_path);
	}
}

class JsonSaver extends FileSaver {

	public function __construct() {
		$this->setPath('json/requests.json');
	}
	
	public function getStorage(): Storage {
		return new JsonStorage($this->file_path);
	}
}


?>