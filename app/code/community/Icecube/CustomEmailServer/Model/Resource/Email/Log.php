<?php

class Icecube_CustomEmailServer_Model_Resource_Email_Log extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('customemailserver/log', 'log_id');
    }
}

