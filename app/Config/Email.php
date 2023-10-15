<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $fromEmail;
    public $fromName  = 'Your Site Name';
    public $recipients;

    public $protocol  = 'smtp';
    public $SMTPHost  = 'smtp.gmail.com';
    public $SMTPUser  = 'jecheatmdr478@gmail.com';  // Votre adresse e-mail Gmail
    public $SMTPPass  = '';      // Votre mot de passe Gmail
    public $SMTPPort  = 587;
    public $SMTPCrypto = 'tls';

    public $CRLF  = "\r\n";
    public $newline = "\r\n";

    public $mailType = 'html';
}
