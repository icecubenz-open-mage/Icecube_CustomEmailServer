<?php

class Icecube_CustomEmailServer_Block_Adminhtml_System_Config_Test extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $originalData = $element->getOriginalData();
        $params = $this->getStoreId() ? array('store' => $this->getStoreId()) : array();

        $this->setElement($element);
        $testType = $originalData['test_type'];
        $url = Mage::getSingleton('adminhtml/url')->getUrl("*/ces_test/$testType", $params);

        return $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setLabel($this->__($originalData['button_label']))
            ->setOnClick("window.location.href='$url'")
            ->toHtml();
    }
}
