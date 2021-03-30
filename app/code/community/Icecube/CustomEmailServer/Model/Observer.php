<?php

class Icecube_CustomEmailServer_Model_Observer extends Varien_Object
{
    /** Called via: Mage_Core_Model_Email
     * Mage::dispatchEvent('email_send_before', array(
     *     'mail'      => $mail,
     *     'template'  => $this->getTemplate(),
     *     'transport' => $transport,
     *     'variables' => $mail->getTemplateVars()
     * ));
     */
    /**
     * Dispatched before email is sent
     *
     * @param Varien_Event_Observer $observer
     */
    public function emailBefore(Varien_Event_Observer $observer)
    {
        // set the SMTP transport
        $observer->getEvent()->getTransport()->setTransport($this->_transportSmtp());
    }

    /** Called via: Mage_Core_Model_Email
     * Mage::dispatchEvent('email_send_after', array(
     *     'to'         => $mail->getToEmail(),
     *     'subject'    => $mail->getSubject(),
     *     'email_body' => $mail->getBody()
     * ));
     */
    /**
     * Dispatched after Email is sent
     *
     * @param Varien_Event_Observer $observer
     */
    public function emailAfter(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('customemailserver');
        if (!$helper->isLogEnabled()) {
            return $this;
        }

        $log = Mage::getModel('customemailserver/email_log');
        try {
            $log->setType(Icecube_CustomEmailServer_Model_Email_Log_Type::TYPE_EMAIL_SEND_AFTER)
                ->setTo($observer->getEvent()->getTo())
                ->setContent($observer->getEvent()->getEmailBody())
                ->save();
        } catch (Exception $e) {}

        return $this;
    }

    /** Called via: Mage_Newsletter_Model_Template
     * Mage::dispatchEvent('newsletter_send_before', array(
     *     'mail'       => $mail,
     *     'transport'  => $transport,
     *     'template'   => $template,
     *     'subscriber' => $subscriber
     * ));
     */
    /**
     * Dispatched before Newsletter is sent
     *
     * @param Varien_Event_Observer $observer
     */
    public function newsletterBefore(Varien_Event_Observer $observer)
    {
        // set the SMTP transport
        $observer->getEvent()->getTransport()->setTransport($this->_transportSmtp());
    }

    /** Called via: Mage_Newsletter_Model_Template
     * Mage::dispatchEvent('newsletter_send_after', array(
     *     'to'         => $email,
     *     'html'       => !$this->isPlain(),
     *     'queue'      => $queue,
     *     'subject'    => $mail->getSubject(),
     *     'email_body' => $text
     * ));
     */
    /**
     * Dispatched after Newsletter is sent
     *
     * @param Varien_Event_Observer $observer
     */
    public function newsletterAfter(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('customemailserver');
        if (!$helper->isLogEnabled()) {
            return $this;
        }

        $log = Mage::getModel('customemailserver/email_log');
        try {
            $log->setType(Icecube_CustomEmailServer_Model_Email_Log_Type::TYPE_NEWSLETTER_SEND_AFTER)
                ->setTo($observer->getEvent()->getTo())
                ->setContent($observer->getEvent()->getEmailBody())
                ->save();
        } catch (Exception $e) {}

        return $this;
    }

    /** Called via: Mage_Core_Model_Email_Queue
     * Mage::dispatchEvent('email_queue_send_before', array(
     *     'mail'      => $mailer,
     *     'message'   => $message,
     *     'transport' => $transport
     * ));
     */
    /**
     * Dispatched before Queue email is sent
     *
     * @param Varien_Event_Observer $observer
     */
    public function queueBefore(Varien_Event_Observer $observer)
    {
        // set the SMTP transport
        $observer->getEvent()->getTransport()->setTransport($this->_transportSmtp());
    }

    /** Called via: Mage_Core_Model_Email_Queue
     * Mage::dispatchEvent('email_queue_send_after', array(
     *     'to'         => $email,
     *     'html'       => !$parameters->getIsPlain(),
     *     'subject'    => $parameters->getSubject(),
     *     'email_body' => $message->getMessageBody()
     * ));
     */
    /**
     * Dispatched after Queue email is sent
     *
     * @param Varien_Event_Observer $observer
     */
    public function queueAfter(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('customemailserver');
        if (!$helper->isLogEnabled()) {
            return $this;
        }

        $log = Mage::getModel('customemailserver/email_log');
        try {
            $log->setType(Icecube_CustomEmailServer_Model_Email_Log_Type::TYPE_EMAIL_QUEUE_SEND_AFTER)
                ->setTo($observer->getEvent()->getTo())
                ->setContent($observer->getEvent()->getEmailBody())
                ->save();
        } catch (Exception $e) {}

        return $this;
    }

    /** Called via: Mage_Core_Model_Email_Template
     * Mage::dispatchEvent('email_template_send_before', array(
     *     'mail'      => $mail,
     *     'template'  => $this,
     *     'transport' => $transport,
     *     'variables' => $variables
     * ));
     */
    /**
     * Dispatched before Template email is sent
     *
     * @param Varien_Event_Observer $observer
     */
    public function templateBefore(Varien_Event_Observer $observer)
    {
        // set the SMTP transport
        $observer->getEvent()->getTransport()->setTransport($this->_transportSmtp());
    }

    /** Called via: Mage_Core_Model_Email_Template
     * Mage::dispatchEvent('email_template_send_after', array(
     *     'to'         => $email,
     *     'html'       => !$this->isPlain(),
     *     'subject'    => $subject,
     *     'template'   => $this->getTemplateId(),
     *     'email_body' => $text
     * ));
     */
    /**
     * Dispatched after Template email is sent
     *
     * @param Varien_Event_Observer $observer
     */
    public function templateAfter(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('customemailserver');
        if (!$helper->isLogEnabled()) {
            return $this;
        }

        $log = Mage::getModel('customemailserver/email_log');
        try {
            $log->setType(Icecube_CustomEmailServer_Model_Email_Log_Type::TYPE_EMAIL_TEMPLATE_SEND_AFTER)
                ->setTo($observer->getEvent()->getTo())
                ->setContent($observer->getEvent()->getEmailBody())
                ->save();
        } catch (Exception $e) {}

        return $this;
    }

    private function _transportSmtp()
    {
        return Mage::getModel('customemailserver/transport_smtp')->getTransport(Mage::app()->getStore()->getStoreId());
    }
}
