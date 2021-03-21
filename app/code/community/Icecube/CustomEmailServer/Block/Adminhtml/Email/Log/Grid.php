<?php

class Icecube_CustomEmailServer_Block_Adminhtml_Email_Log_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('emaillogsgrid');
        $this->setDefaultSort('log_id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customemailserver/email_log')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('log_id', array(
            'header'    => Mage::helper('core')->__('Log ID'),
            'width'     => '50px',
            'align'     => 'left',
            'index'     => 'log_id',
        ));

        $this->addColumn('type', array(
            'header'    => Mage::helper('core')->__('Type'),
            'index'     => 'type',
            'type'      => 'options',
            'options'   => Mage::getSingleton('customemailserver/email_log_type')->getOptions(),
        ));

        $this->addColumn('to', array(
            'header'    => Mage::helper('core')->__('Email To'),
            'align'     => 'left',
            'index'     => 'to',
        ));

        $this->addColumn('content', array(
            'header'    => Mage::helper('core')->__('Email Content'),
            'align'     => 'left',
            'sortable'  => false,
            'frame_callback' => array($this, 'renderContent'),
            'index'     => 'content',
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('core')->__('Time'),
            'index'     => 'created_at',
            'type'      => 'datetime',
        ));

        return parent::_prepareColumns();
    }

    public function renderContent($value)
    {
        return '<div style="height: 75px; overflow: auto;">' . str_replace("\n", "<br/>", $value) . '</div>';
    }
}
