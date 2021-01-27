<?php

class Icecube_CustomEmailServer_Block_Adminhtml_System_Config_Test extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $url = Mage::getSingleton('adminhtml/url')->getUrl('*/ces_test/test');

        return $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setLabel($this->__('Send Test Email'))
            ->setOnClick("window.location.href='$url'")
            ->toHtml();
    }
}
