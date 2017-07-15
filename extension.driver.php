<?php

    require_once(EXTENSIONS . '/ip_localisation/lib/class.freegeoip_service.php');

    Class extension_ip_localisation extends Extension {

    	public function getSubscribedDelegates() {
    		return array(
    			array(
    				'page' => '/frontend/',
    				'delegate' => 'FrontendParamsResolve',
    				'callback' => 'addParameters'
    			)
    		);
    	}

    	public function addParameters(&$context) {
    		session_start();

            // Last request was more than 1 day ago, so reset the country and data sessions
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 86400)) {
    			unset($_SESSION['country-code']);
    			unset($_SESSION['country-data']);
            }

            // Update last activity time stamp
            $_SESSION['LAST_ACTIVITY'] = time();

            // Set the country code based on URL parameter
    		if ($_GET['set_country_code']) {
                $_SESSION['country-code'] = $_GET['set_country_code'];
            }

            // Clear the country code
    		if (isset($_GET['clear_country_code'])) {
    			unset($_SESSION['country-code']);
    		}

            // Add code to parameter pool
    		if (isset($_SESSION['country-code'])) {
            	$context['params']['country'] = $_SESSION['country-code'];
            }
            // If the country code hasn't been set manually, then we need to fetch it
            else {
                // Determine best method of getting Header info
                if (function_exists('apache_request_headers')) {
                    $headers = apache_request_headers();
                }
                else {
                    $headers = $_SERVER;
                }

                // And store the IP address
                if (array_key_exists( 'X-Forwarded-For', $headers) && filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $ip = $headers['X-Forwarded-For'];
                }
                else if (array_key_exists('HTTP_X_FORWARDED_FOR', $headers) && filter_var($headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $ip = $headers['HTTP_X_FORWARDED_FOR'];
                }
                else {
                    $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
                }

                // Perform the lookup and store it
                $data = freegeoip_service_request::ip_lookup($ip);
                // $data = freegeoip_service_request::ip_lookup('google.com');
                $data = json_decode($data);

                // We use this for adding in DS later
                $_SESSION['country-data'] = $data;

                // Add the country parameter
            	$context['params']['country'] = $data->country_code;
            }
        }
    }

?>
