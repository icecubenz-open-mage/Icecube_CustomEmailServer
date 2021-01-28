<?php

class Icecube_CustomEmailServer_Ces_TestController extends Mage_Adminhtml_Controller_Action
{
    const CONTACT                = 'general';
    const XML_PATH_CONTACT_NAME  = 'trans_email/ident_%s/email';
    const XML_PATH_CONTACT_EMAIL = 'trans_email/ident_%s/name';

    public function emailAction()
    {
        /** @var Mage_Core_Model_Email $mailer */
        $mail = Mage::getModel('core/email')
            ->setToEmail($this->_helper()->getTestEmailAddress())
            ->setBody('This is a test email - your email settings are correct!')
            ->setSubject('Test Email')
            ->setFromName($this->_getContactName())
            ->setFromEmail($this->_getContactEmail())
            ->setType('text');

        try {
            $mail->send();
            Mage::getSingleton('core/session')->addSuccess('Test Email Sent!');
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('core/session')->addError($this->__('An error occurred sending email: %s', $e->getMessage()));
        } finally {
            $this->_redirectReferer();
        }
    }

    public function queueAction()
    {
        /** @var Mage_Core_Model_Email_Queue $mailer */
        $emailQueue = Mage::getModel('core/email_queue');
        $emailQueue->setEntityId(0)
            ->setEntityType('test')
            ->setEventType('test')
            ->setIsForceCheck(false);

        $mailer = $this->_getMailer('queue');
        try {
            $mailer->setQueue($emailQueue)->send();
            Mage::getSingleton('core/session')->addSuccess('Test Queue Email Sent!');
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('core/session')->addError($this->__('An error occurred sending email: %s', $e->getMessage()));
        } finally {
            $this->_redirectReferer();
        }
    }

    public function newsletterAction()
    {
        /** @var Mage_Newsletter_Model_Template $mailer */
        $newsletter = Mage::getModel('newsletter/template')
            ->setTemplateText('This is a test newsletter - your email settings are correct!')
            ->setTemplateSubject('Test Newsletter')
            ->setTemplateSenderName($this->_getContactName())
            ->setTemplateSenderEmail($this->_getContactEmail())
            ->setTemplateType(Mage_Newsletter_Model_Template::TYPE_TEXT);

        try {
            $newsletter->send($this->_helper()->getTestEmailAddress());
            Mage::getSingleton('core/session')->addSuccess('Test Newsletter Sent!');
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('core/session')->addError($this->__('An error occurred sending email: %s', $e->getMessage()));
        } finally {
            $this->_redirectReferer();
        }
    }

    public function templateAction()
    {
        $mailer = $this->_getMailer('template');
        try {
            $mailer->send();
            Mage::getSingleton('core/session')->addSuccess('Test Template Email Sent!');
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('core/session')->addError($this->__('An error occurred sending email: %s', $e->getMessage()));
        } finally {
            $this->_redirectReferer();
        }
    }

    private function _getContactEmail() {
        return Mage::getStoreConfig(sprintf(self::XML_PATH_CONTACT_EMAIL, self::CONTACT));
    }

    private function _getContactName() {
        return Mage::getStoreConfig(sprintf(self::XML_PATH_CONTACT_EMAIL, self::CONTACT));
    }

    private function _getMailer($testType) {
        /** @var Mage_Core_Model_Email_Info $emailInfo */
        $emailInfo = Mage::getModel('core/email_info');
        $emailInfo->addTo($this->_helper()->getTestEmailAddress());

        $data = new Varien_Object(array('comment' => "This is a test $testType email - your email settings are correct!"));

        /** @var Mage_Core_Model_Email_Template_Mailer $mailer */
        $mailer = Mage::getModel('core/email_template_mailer')
            ->addEmailInfo($emailInfo)
            ->setSender(self::CONTACT)
            ->setStoreId(Mage_Core_Model_App::ADMIN_STORE_ID)
            ->setTemplateId($this->_helper()->getTestEmailTemplate())
            ->setTemplateParams(array( 'data' => $data ));

        return $mailer;
    }

    private function _helper() {
        return Mage::helper('customemailserver');
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('admin/system/smtp');
    }
}
