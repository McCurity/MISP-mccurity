<?php

class PANEDLExport
{
        public $additional_params = array(
                'flatten' => 1
        );

        private $__resultSet = [];

        public function handler($data, $options = array())
        {
                if ($options['scope'] === 'Attribute') {
                        if ($data['Attribute']['type'] === 'url') {
                                $pattern = '/^https?:\/\//i';
                                $this->__resultSet[preg_replace($pattern, '', $data['Attribute']['value'])] = true;
                        } elseif (in_array($data['Attribute']['type'], array("ip-src", "ip-dst", "hostname", "domain"), true) ) {
                                $this->__resultSet[$data['Attribute']['value']] = true;
                        }
                }
                return '';
        }

        public function header($options = array())
        {
                return '';
        }

        public function footer($options = array())
        {
                return implode("\n", array_keys($this->__resultSet)) . "\n";
        }

        public function separator()
        {
                return '';
        }
}
