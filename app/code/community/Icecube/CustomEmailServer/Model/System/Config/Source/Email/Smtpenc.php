<?php

class Icecube_CustomEmailServer_Model_System_Config_Source_Email_SmtpEnc
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => Icecube_CustomEmailServer_Helper_Smtpenc::SMTPENC_TYPE_NONE,
                'label' => Mage::helper('customemailserver')->__('None')
            ),
            array(
                'value' => Icecube_CustomEmailServer_Helper_Smtpenc::SMTPENC_TYPE_SSL,
                'label' => Mage::helper('customemailserver')->__('SSL')
            ),
            array(
                'value' => Icecube_CustomEmailServer_Helper_Smtpenc::SMTPENC_TYPE_TLS,
                'label' => Mage::helper('customemailserver')->__('TLS')
          ),
        );
    }
}
