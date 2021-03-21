<?php

class Icecube_CustomEmailServer_Model_Resource_Email_Log_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('customemailserver/email_log');
    }
}

