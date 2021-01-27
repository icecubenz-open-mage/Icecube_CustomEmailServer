<?php

class Icecube_CustomEmailServer_Ces_TestController extends Mage_Adminhtml_Controller_Action
{
    public function testAction()
    {
        /** @var Mage_Core_Model_Email_Template_Mailer $mailer */
        $mailer    = Mage::getModel('core/email_template_mailer');
        $emailInfo = Mage::getModel('core/email_info');
        $emailInfo->addTo($this->_helper()->getTestEmailAddress());
        $mailer->addEmailInfo($emailInfo);
        $mailer->setSender('general');
        $mailer->setStoreId(Mage_Core_Model_App::ADMIN_STORE_ID);
        $mailer->setTemplateId($this->_helper()->getTestEmailTemplate());
        $data = new Varien_Object(
            array(
                'name'    => 'Custom Email Server extension',
                'email'   => 'test@example.com',
                'comment' => 'This is a test email - your email settings are correct!'
            )
        );
        $mailer->setTemplateParams(array( 'data' => $data ));
        try {
            $mailer->send();
            Mage::getSingleton('core/session')->addSuccess('Test Email Sent!');
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('core/session')->addError($this->__('An error occurred during sending email: %s', $e->getMessage()));
        } finally {
            $this->_redirectReferer();
        }
    }

    protected function _helper() {
        return Mage::helper('customemailserver');
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('admin/system/smtp');
    }
}
