<?php

class Icecube_CustomEmailServer_Model_Email_Log_Type
{
    const TYPE_EMAIL_SEND_AFTER          = 'email_send_after';
    const TYPE_EMAIL_QUEUE_SEND_AFTER    = 'email_queue_send_after';
    const TYPE_EMAIL_TEMPLATE_SEND_AFTER = 'email_template_send_after';
    const TYPE_NEWSLETTER_SEND_AFTER     = 'newsletter_send_after';

    public function getOptions()
    {
        return array(
            self::TYPE_EMAIL_SEND_AFTER          => self::TYPE_EMAIL_SEND_AFTER,
            self::TYPE_EMAIL_QUEUE_SEND_AFTER    => self::TYPE_EMAIL_QUEUE_SEND_AFTER,
            self::TYPE_EMAIL_TEMPLATE_SEND_AFTER => self::TYPE_EMAIL_TEMPLATE_SEND_AFTER,
            self::TYPE_NEWSLETTER_SEND_AFTER     => self::TYPE_NEWSLETTER_SEND_AFTER
        );
    }
}
