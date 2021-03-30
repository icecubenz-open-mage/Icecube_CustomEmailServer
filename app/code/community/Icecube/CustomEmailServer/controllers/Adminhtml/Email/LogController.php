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

    public function clearAction()
    {
        try {
            $table = Mage::getResourceModel('customemailserver/email_log')->getMainTable();

            $resource = Mage::getSingleton('core/resource');
            $connection = $resource->getConnection('customemailserver_write');
            $connection->truncate($table);

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('customemailserver')->__('Email logs have been removed.')
            );

            $this->_redirect('*/*/');
            return;
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()->addException($e,
                Mage::helper('customemailserver')->__('An error occurred while removing email logs.'));
        }

        $this->_redirect('*/*/');
    }

    public function previewAction()
    {
        $this->_title($this->__('Email Logs'))->_title($this->__('Email Content'));
        $this->loadLayout();

        $data = $this->getRequest()->getParams();
        if (empty($data) || !isset($data['id'])) {
            $this->_forward('noRoute');
            return $this;
        }

        $this->renderLayout();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/email_log');
    }
}
