<?php

    require_once(EXTENSIONS . '/ip_localisation/lib/class.geobytes_service.php');

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
                if ($_GET['set_region_code']) {
                    $_SESSION['region-code'] = $_GET['set_region_code'];
                }
                else {
                    $_SESSION['region-code'] = '';
                }
            }

            // Clear the country code
    		if (isset($_GET['clear_country_code'])) {
    			unset($_SESSION['country-code']);
    		}

            // Add code to parameter pool
    		if (isset($_SESSION['country-code'])) {
            	$context['params']['country'] = $_SESSION['country-code'];
            	$context['params']['region'] = $_SESSION['region-code'];
            }
            // If the country code hasn't been set manually, then we need to fetch it
            else {
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                }
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

                // Perform the lookup and store it
                $data = geobytes_service_request::ip_lookup($ip);
                // $data = geobytes_service_request::ip_lookup('172.217.25.142');
                $data = json_decode($data);

                // We use this for adding in DS later
                $_SESSION['country-data'] = $data;

                // Add the country parameter
                if (empty($data->geobytesinternet)) {
        	       $context['params']['country'] = 'nz';
                }
                else {
        	       $context['params']['country'] = strtolower($data->geobytesinternet);
                }

                // Add the region parameter
                if (empty($data->geobytesregion)) {
        	       $context['params']['region'] = 'otago';
                }
                else {
        	       $context['params']['region'] = strtolower($data->geobytesregion);
                }

                // Update the session with country and region
                $_SESSION['country-code'] = $context['params']['country'];
                $_SESSION['region-code'] = $context['params']['region'];
            }
        }
    }

?>
