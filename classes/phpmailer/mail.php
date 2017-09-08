<?php
include('phpmailer.php');
class Mail extends PhpMailer
{
    // Set default variables for all new objects
    public $From     = 'propuestas@concejorosario.gov.ar';
    public $FromName = IPP;
    public $Host     = 'smtp.gmail.com';
    public $Mailer   = 'smtp';
    public $SMTPAuth = true;
    //public $Username = 'fpalossi@gmail.com';
    public $Username = 'propuestas@concejorosario.gov.ar';
    public $Password = 'parapente';
    //public $Password = 'PRM28392051';
    public $SMTPSecure = 'tls';
    public $WordWrap = 75;
    public $Port = 587;
    //public $Port = 465; este lo puse yo

    public function subject($subject)
    {
        $this->Subject = $subject;
    }

    public function body($body)
    {
        $this->Body = $body;
    }

    public function send()
    {
        $this->AltBody = strip_tags(stripslashes($this->Body))."\n\n";
        $this->AltBody = str_replace("&nbsp;", "\n\n", $this->AltBody);
        return parent::send();
    }
}
