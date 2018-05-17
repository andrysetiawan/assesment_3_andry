<?php
/*
  Plugin Name: Hook Assesment 3
  Description: Hook Assesment 3
  Version: 1.0.0
  Author: SoftwareSeni
  License: GPLv2
 */

/**
 * 
 */
if(!class_exists('AssesmentTiga'))
{
	class AssesmentTiga
	{
		
		protected static $instance = null;

        public static function instance() {
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        function __construct()
		{
			add_filter('assesment_3_timezones',array($this,'populate_timezone'));
			add_action('assesment_3_after_render',array($this,'add_title'));
			
		}
		function populate_timezone()
		{
			$new_val = [];
			$jsontimezone = "https://raw.githubusercontent.com/dmfilipenko/timezones.json/master/timezones.json";
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $jsontimezone);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    $output = curl_exec($ch);
		    curl_close($ch);
		    $sms_response_id = $output;
		    $decodetimezone = json_decode($output);
		    foreach ($decodetimezone as $value) {
		    	$new_val["$value->text"] = $value->value;
		    }
		    return $new_val;
		}
		

		function add_title()
		{
			echo "Silahkan pilih timezone Anda:";
		}
		
	}
}
if (!function_exists('AssesmentTiga')) {
    function AssesmentTiga() {
        return AssesmentTiga::instance();
    }
}

AssesmentTiga();