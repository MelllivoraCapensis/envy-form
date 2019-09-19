<?php

class Config {
	const HOST = '127.0.0.1',
		DB_NAME = 'envy_form',
		USER = 'root',
		PASSWORD = '',
		CHARSET = 'utf8',
		TABLE = 'requests',
		DATAFILE_BASE_DIR = 'data/',
		PDO_OPT = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,],
		FILE_FIELD_SEP = '<***>',
		FILE_LINE_SEP = "\r\n";
}

?>