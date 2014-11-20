<?php

/*
 *
 */

namespace Libs;

/**
 * Description of SendMail
 * This class is responsible to send mail using PHPMailer class 'mail' function.
 *
 * @author narendra.singh
 */
class SendMail
{

    private $_mailer;

    /**
     *
     */
    function __construct ()
    {
        if (!$this->_mailer) {
            $this->_mailer = new \PHPMailer();
        }
    }

    /**
     *
     * @param object $config
     * @throws Exception
     */
    public function setConfig ($config)
    {
        if (!empty($config) && is_object($config)) {
            $this->_mailer->isSMTP();
            $this->_mailer->SMTPDebug = $config->smtpDebug;
            $this->_mailer->Debugoutput = $config->debugoutput;
            $this->_mailer->Host = $config->host;
            $this->_mailer->Port = $config->port;
            $this->_mailer->SMTPSecure = $config->smtpSecure;
            $this->_mailer->SMTPAuth = $config->smtpAuth;
            $this->_mailer->Username = $config->username;
            $this->_mailer->Password = $config->password;
            $this->_mailer->setFrom($config->fromEmail, $config->fromName);
            $this->_mailer->addReplyTo($config->replyToEmail, $config->replyToName);
        } else {
            throw new Exception("Config can\'t be blank..!!");
        }
    }

    /**
     *
     * @param object $recipients
     * @throws Exception
     */
    public function setRecipient ($recipients = array ())
    {
        if (!empty($recipients) && is_array($recipients)) {
            foreach ($recipients as $recipient) {
                $this->_mailer->addAddress($recipient->toEmail, $recipient->toName);
            }
        } else {
            throw new Exception("Config can\'t be blank..!!");
        }
    }

    /**
     *
     * @param string $subject
     * @param string $message
     * @param string $attachment
     * @throws Exception
     */
    public function sendMail ($subject, $message, $attachment = null)
    {
        $this->_mailer->Subject = $subject;
        $this->_mailer->msgHTML($message);
        if ($attachment) {
            $this->_mailer->addAttachment($attachment);
        }
        if (!$this->_mailer->send()) {
            throw new \Exception(" Error occured while sending mail : ". $this->_mailer->ErrorInfo);
        } else {
            return true;
        }
    }

}
