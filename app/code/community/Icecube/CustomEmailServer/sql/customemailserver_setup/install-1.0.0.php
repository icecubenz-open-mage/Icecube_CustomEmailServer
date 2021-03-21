<?php

$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()
    ->newTable($installer->getTable('customemailserver/log'))
    ->addColumn('log_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Log ID')
    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Type')
    ->addColumn('to', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Email To')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        'nullable'  => true,
    ), 'Content')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => false,
        'default'  => Varien_Db_Ddl_Table::TIMESTAMP_INIT
    ), 'Email send timestamp')
    ->setComment('Email send log');

$installer->getConnection()->createTable($table);
$installer->endSetup();
