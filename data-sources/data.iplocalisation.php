<?php

    require_once(TOOLKIT . '/class.datasource.php');

    Class datasourceiplocalisation extends Datasource {
        public $dsParamROOTELEMENT = 'ip-localisation';

        public function about(){
            return array(
                'name' => 'IP Localisation',
                'version' => '1.0.0',
                'release-date' => '2017-05-15',
                'author' => array(
                    'name' => 'Phill Gray',
                    'website' => 'https://thebold.nz'
                )
            );
        }

        public function execute() {
            $data = $_SESSION['country-data'];

            if (is_object($data)) {
                $data = JSON::convertToXML(json_encode($data), false);
            }
            else {
                $data = JSON::convertToXML($data, false);
            }

            $data = preg_replace('/<\\/?data(\\s+.*?>|>)/', '', $data);

            $result = new XMLElement($this->dsParamROOTELEMENT, $data);

            return $result;
        }
    }
