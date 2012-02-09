<?php defined('SYSPATH') or die('No direct access allowed.');

/**********************************

    DATABASE CONFIGURATION
	
    Kohana will automatically determine
    which connection to use based on the
    environment settings

**********************************/

return array(
	// TESTING ENVIRONMENT
	Kohana::TESTING => array(
		'type' => 'mysql',
		'connection'   => array(
			'hostname'   => 'localhost',
			'username'   => 'root',
			'password'   => '',
			'database'   => 'bnotions.fb_efog'
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE
	),
		
	// DEVELOPMENT ENVIRONMENT
	Kohana::DEVELOPMENT => array(
		'type' => 'mysql',
		'connection'   => array(
			'hostname'   => '',
			'username'   => '',
			'password'   => '',
			'database'   => ''
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE
	),
	
	// STAGING ENVIRONMENT
	Kohana::STAGING => array(
		'type' => 'mysql',
		'connection'   => array(
			'hostname'   => 'localhost',
			'username'   => '',
			'password'   => '',
			'database'   => ''
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE
	),
	
	// PRODUCTION ENVIRONMENT
	Kohana::PRODUCTION => array(
		'type' => 'mysql',
		'connection'   => array(
			'hostname'   => 'localhost',
			'username'   => 'root',
			'password'   => 'n1FhasHFODRtbK',
			'database'   => 'efog'
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE
	)
	
);
