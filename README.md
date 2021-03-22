# Custom Email Server for OpenMage

This extension adds support for authenticated SMTP mail servers to Open Mage.

This extension relies on events emitted by `Mage_Core_Model_Email`, `Mage_Core_Model_Email_Template`, `Mage_Core_Model_Email_Queue` and `Mage_Newsletter_Model_Template` without core rewrites.

This extension is not currently usable without patching OpenMage core such as via this patch: https://gist.github.com/rjocoleman/5403c927424f967b0a9b778e58b933b8

If this patch is made (for example via [`cweagans/composer-patches`](https://github.com/cweagans/composer-patches)) this extension can be used as below!

## Usage

1. Remove any extension that rewrites the core above, ideally they'd be refactored to use the events from the patch.

```shell
$ composer require icecube/custom-email-server
```

2. Configure SMTP Host, Port, SSL/TLS, Username and Password in `System Configuration -> Advanced -> System -> Mail Sending Settings`. Once saved a test email can be sent.

3. Emails that use the core methods named above to send will use these SMTP settings.

![](https://www.dropbox.com/s/xp7guc4zuhpyvko/Screen_Shot_2021-01-28_at_2.29.34_PM.png?dl=1)

### Email Logs

By default emails are also logged in the DB and available to view in the `System` -> `Email Logs` menu.


## History

OpenMage has inherited difficulties with sending by SMTP from Magento 1. SMTP extensions are very popular and unfortunately most, if not all, rewrite some core classes to add support. This is problematic as core rewrites should be avoided where possible - core rewrites can easily get out of date, conflict with other extensions or multiple rewrites end up competing/interacting in unpredictable ways.

This is compounded by the fact that there are many competiting SMTP extensions as this is a very common feature lacking from core - and some cases users end up with more than one SMTP extension rewriting the core classes. (Several large extension m)

Magento 1 had several ways of sending email - `Email`, `Template` and `Newsletter`, later in its development cycle Magento 1 introduced an email `Queue` and moved most email sending to that style.

The stock Magento 1 configuration in `System Configuration -> Advanced -> System -> Mail Sending Settings` includes support for `Host` and `Port` but these configuration elements have comments saying they're "for Windows servers only". These configuration values are used for PHP's `ini_set` method to configure PHP's [`mail`](https://www.php.net/manual/en/mail.configuration.php) extension

OpenMage / Magento 1's mail features are built on top of Zend Framework 1 specifically `Zend_Mail` which handles the mail sending.
`Zend_Mail` supports `Transports` to take care of the actual delivery. These are modular and aside from configuration reasonably generic. Stock OpenMage / Magento 1 configures no transport, which in turn passes to PHP's [`mail()`](https://www.php.net/manual/en/function.mail.php) function which tries to use `sendmail` installed on Linux servers (or SMTP on windows). Having `sendmail` installed and configured on Linux servers is often not possible these days.

Thus, using a `Zend_Mail` SMTP transport to send to an external SMTP server configured directly from OpenMage's System Configuration is preferable in many cases. The `Zend_Mail_Transport_Smtp` is included in OpenCore / Magento 1 but the code is not used.

What many Magento 1 SMTP extensions do:

* Rewrite Core classes: `Mage_Core_Model_Email`, `Mage_Core_Model_Email_Template`, `Mage_Core_Model_Email_Queue` and sometimes `Mage_Newsletter_Model_Template`.

* Usually just the `$mail->send()` or equivalent function is rewritten.

* Add a set of system configuration values for SMTP authentication, seperate from the existing core mail sending settings.

* Pull these configuration values and add them to a new instance of `Zend_Mail_Transport_Smtp`

* Pass this transport to the `Zend_Mail` object and it's used when `$mail->send()` is called rather than the default `sendmail` transport.

* In some cases SMTP extensions add message logging or debug too.

* In some cases the core overwrites are limited to adding custom events which can then be observed and manipulated. If OpenMage had events set before and after sending email, that could be used by any other third party extension without core rewrites to set `Zend_Mail` transports, or otherwise manipulate the message before (e.g. SMTP, automatic attachments) or after sending (e.g. debug logs).

In summary, Magento 1 and OpenMage by extension do not have robust email sending handling. It's a common use case. The email sending classes do not include events to allow third parties to do this, if they did then an extension like this one could be used to add additional features to the standard configuration settings and send email via SMTP without rewrites.

## OpenMage Events

In the case that you have applied the aforementioned patch to OpenMage this repo also acts as a proof of concept for interaction with those events.
Observer examples are in `Icecube_CustomEmailServer_Model_Observer` and they're configured in `app/core/community/Icecube/CustomEmailServer/etc/config.xml`.
`_before` and `_after` events for all email events are used as examples.

Most of these are not required for the features of this extenion and those observers are commented out so that the observer is not run!
