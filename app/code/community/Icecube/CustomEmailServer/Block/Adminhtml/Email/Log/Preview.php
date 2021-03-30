<?php

class Icecube_CustomEmailServer_Block_Adminhtml_Email_Log_Preview extends Mage_Adminhtml_Block_Template
{
    protected function _toHtml()
    {
        $log = Mage::getModel('customemailserver/email_log');

        if($id = (int)$this->getRequest()->getParam('id')) {
            $log->load($id);
            if ($log->getId()) {
                return $log->getContent();
            }
        }

        return '';
    }
}

