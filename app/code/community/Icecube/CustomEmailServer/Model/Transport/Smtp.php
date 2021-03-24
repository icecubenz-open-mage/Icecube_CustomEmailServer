<?php

class Icecube_CustomEmailServer_Model_Transport_Smtp
{
    public function getTransport($storeId = null)
    {
        $transport = new Zend_Mail_Transport_Smtp($this->_helper()->getHost($storeId), $this->getTransportConfig($storeId));
        return $transport;
    }

    public function getTransportConfig($storeId = null)
    {
        $port     = $this->_helper()->getPort($storeId);
        $auth     = $this->_helper()->getAuth($storeId);
        $enc      = $this->_helper()->getEncryption($storeId);
        $username = $this->_helper()->getUsername($storeId);
        $password = $this->_helper()->getPassword($storeId);

        $config = array();
        $config['name'] = gethostname();
        
        if (isset($auth)) {
            $config['auth']     = $auth;
            $config['username'] = $username;
            $config['password'] = $password;
        }

        if (isset($port)) {
            $config['port'] = $port;
        }

        if (isset($enc)) {
            $config['ssl'] = $enc;
        }

        return $config;
    }

    protected function _helper() {
        return Mage::helper('customemailserver');
    }
}
