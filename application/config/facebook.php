<?php defined('SYSPATH') or die('No direct script access.');

/**********************************

    FACEBOOK CONFIGURATION
	
    Kohana will automatically determine
    which settings to use based on the
    environment settings

**********************************/

return array(
	
	// TESTING ENVIRONMENT
	Kohana::TESTING => array(
                'app_id'                    => '135906693197237',
                'secret'                    => '4996809198c71a4d32c994ee2abbb89b',
                'file_upload'               => false,
                'canvas_path'               => '',
                'page_path'                 => '',
                'page_url'                  => '',
                'page_id'                   => '',	
                'permissions'               => array(),
                'ignore_ssl_verification'   => true,
                'cookie'                    => true
	),
		
	// DEVELOPMENT ENVIRONMENT
	Kohana::DEVELOPMENT => array(
                'app_id'                    => '',
                'secret'                    => '',
                'file_upload'               => false,
                'canvas_path'               => '',
                'page_path'                 => '',
                'page_url'                  => '',
                'page_id'                   => '',	
                'permissions'               => array(),
                'ignore_ssl_verification'   => true,
                'cookie'                    => true
	),
		
	// STAGING ENVIRONMENT
	Kohana::STAGING => array(
                'app_id'                    => '',
                'secret'                    => '',
                'file_upload'               => false,
                'canvas_path'               => '',
                'page_path'                 => '',
                'page_url'                  => '',
                'page_id'                   => '',	
                'permissions'               => array(),
                'ignore_ssl_verification'   => true,
                'cookie'                    => true
	),			

	// PRODUCTION ENVIRONMENT
	Kohana::PRODUCTION => array(
                'app_id'                    => '',
                'secret'                    => '',
                'file_upload'               => false,
                'canvas_path'               => '',
                'page_path'                 => '',
                'page_url'                  => '',
                'page_id'                   => '',	
                'permissions'               => array(),
                'ignore_ssl_verification'   => true,
                'cookie'                    => true
	),
								
);
