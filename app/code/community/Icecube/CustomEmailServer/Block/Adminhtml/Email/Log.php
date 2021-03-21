<?php

class Icecube_CustomEmailServer_Block_Adminhtml_Email_Log extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected $_blockGroup = 'customemailserver';

    public function __construct()
    {
        $this->_controller = 'adminhtml_email_log';
        $this->_headerText = Mage::helper('core')->__('Email Logs');

        parent::__construct();

        $this->_removeButton('add');
    }
}

