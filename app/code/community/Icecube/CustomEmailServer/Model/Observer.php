<?php

class Icecube_CustomEmailServer_Model_Observer extends Varien_Object
{
    // Mage::dispatchEvent('newsletter_send_before', array(
    //     'mail'       => $mail,
    //     'transport'  => $transport,
    //     'variables'  => $variables,
    //     'subscriber' => $subscriber
    // ));
    public function newsletterBefore(Varien_Event_Observer $observer)
    {
        $observer->getEvent()->getTransport()->setTransport($this->_transport());
    }

    // Mage::dispatchEvent('newsletter_send_after', array(
    //     'to'         => $email,
    //     'html'       => !$this->isPlain(),
    //     'queue'      => $queue,
    //     'subject'    => $mail->getSubject(),
    //     'email_body' => $text
    // ));
    public function newsletterAfter(Varien_Event_Observer $observer)
    {

    }

    // Mage::dispatchEvent('email_queue_send_before', array(
    //     'mail'      => $mailer,
    //     'message'   => $message,
    //     'transport' => $transport
    // ));
    public function queueBefore(Varien_Event_Observer $observer)
    {
        $observer->getEvent()->getTransport()->setTransport($this->_transport());
    }

    // Mage::dispatchEvent('email_queue_send_after', array(
    //     'to'         => $email,
    //     'html'       => !$parameters->getIsPlain(),
    //     'subject'    => $parameters->getSubject(),
    //     'email_body' => $message->getMessageBody()
    // ));
    public function queueAfter(Varien_Event_Observer $observer)
    {

    }

    // Mage::dispatchEvent('email_template_send_before', array(
    //     'mail'      => $mail,
    //     'template'  => $this,
    //     'transport' => $transport,
    //     'variables' => $variables
    // ));
    public function templateBefore(Varien_Event_Observer $observer)
    {
        $observer->getEvent()->getTransport()->setTransport($this->_transport());
    }

    // Mage::dispatchEvent('email_template_send_after', array(
    //     'to'         => $email,
    //     'html'       => !$this->isPlain(),
    //     'subject'    => $subject,
    //     'template'   => $this->getTemplateId(),
    //     'email_body' => $text
    // ));
    public function templateAfter(Varien_Event_Observer $observer)
    {

    }

    private function _transport()
    {
        return Mage::getModel('customemailserver/transport_smtp')->getTransport(Mage::app()->getStore()->getStoreId());
    }
}
