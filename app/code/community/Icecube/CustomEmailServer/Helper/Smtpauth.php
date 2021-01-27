<?php

class Icecube_CustomEmailServer_Helper_Smtpauth extends Mage_Core_Helper_Abstract
{
    const SMTPAUTH_TYPE_NONE    = '';
    const SMTPAUTH_TYPE_PLAIN   = 'plain';
    const SMTPAUTH_TYPE_LOGIN   = 'login';
    const SMTPAUTH_TYPE_CRAMMD5 = 'crammd5';
}
