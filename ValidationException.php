<?php 

class ValidationException extends Exception {
	private $data;

	public function __construct($key, $message) {
		$this->data = [$key => $message];
		parent::__construct($message);
	}

	// return exception text with field key for more convenient rendering error-alert
	public function getData() {
		return $this->data;
	}
}
?>