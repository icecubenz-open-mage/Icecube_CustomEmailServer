<?php

class Icecube_CustomEmailServer_Block_Adminhtml_Email_Log_Grid_Renderer_Action
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $link = $this->getUrl('*/*/preview', array('id' => $row->getId()));

        $popup = 'var win = window.open('
                        . '\'' . $link . '\','
                        . '\'email_content\','
                        . '\'width=500,height=600,resizable=1,scrollbars=1\''
                        . ');'
                . 'win.focus();'
            ;

        return '<a onclick="' . $popup . '">' . $this->__('Preview') . '</a>';
    }
}
