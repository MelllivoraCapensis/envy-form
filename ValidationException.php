<?php 
class ValidationException extends Exception {
	private $data;

	public function __construct($key, $message) {
		$this->data = [$key => $message];
		parent::__construct($message);
	}

	public function getData() {
		return $this->data;
	}
}
?>