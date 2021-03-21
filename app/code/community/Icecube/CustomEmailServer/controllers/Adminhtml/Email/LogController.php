<?php

class Icecube_CustomEmailServer_Adminhtml_Email_LogController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('System'))
             ->_title($this->__('Email Logs'));

        $this->loadLayout()
             ->_setActiveMenu('system/email_log')
             ->renderLayout();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/email_log');
    }
}
