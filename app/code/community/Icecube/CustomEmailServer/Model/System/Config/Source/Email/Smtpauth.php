<?php

class Icecube_CustomEmailServer_Model_System_Config_Source_Email_Smtpauth
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => Icecube_CustomEmailServer_Helper_Smtpauth::SMTPAUTH_TYPE_NONE,
                'label' => Mage::helper('customemailserver')->__('No Authentication')
            ),
            array(
                'value' => Icecube_CustomEmailServer_Helper_Smtpauth::SMTPAUTH_TYPE_LOGIN,
                'label' => Mage::helper('customemailserver')->__('LOGIN')
            ),
            array(
                'value' => Icecube_CustomEmailServer_Helper_Smtpauth::SMTPAUTH_TYPE_PLAIN,
                'label' => Mage::helper('customemailserver')->__('PLAIN')
            ),
            array(
                'value' => Icecube_CustomEmailServer_Helper_Smtpauth::SMTPAUTH_TYPE_CRAMMD5,
                'label' => Mage::helper('customemailserver')->__('CRAM-MD5')
            ),
        );
    }
}
