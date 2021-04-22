<?php

class Icecube_CustomEmailServer_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_DISABLE    = 'system/smtp/disable';
    const XML_PATH_HOST       = 'system/smtp/host';
    const XML_PATH_PORT       = 'system/smtp/port';
    const XML_PATH_AUTH       = 'system/smtp/auth';
    const XML_PATH_ENCRYPTION = 'system/smtp/enc';
    const XML_PATH_USERNAME   = 'system/smtp/username';
    const XML_PATH_PASSWORD   = 'system/smtp/password';
    const XML_PATH_TEST_EMAIL_ADDRESS  = 'system/smtp/test_email_address';
    const XML_PATH_TEST_EMAIL_TEMPLATE = 'contacts/email/email_template';

    public function isEnabled($storeId = null)
    {
        return !(bool)Mage::getStoreConfig(self::XML_PATH_DISABLE, $storeId);
    }

    public function getHost($storeId = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_HOST, $storeId);
    }

    public function getPort($storeId = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_PORT, $storeId);
    }

    public function getAuth($storeId = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_AUTH, $storeId);
    }

    public function getEncryption($storeId = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_ENCRYPTION, $storeId);
    }

    public function getUsername($storeId = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_USERNAME, $storeId);
    }

    public function getPassword($storeId = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_PASSWORD, $storeId);
    }

    public function getTestEmailAddress($storeId = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_TEST_EMAIL_ADDRESS, $storeId);
    }

    public function getTestEmailTemplate($storeId = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_TEST_EMAIL_TEMPLATE, $storeId);
    }
}
