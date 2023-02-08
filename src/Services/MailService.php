<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail()
    {
        $email = (new Email())
            ->from('brucewayne@eni.fr')
            ->to('batman@eni.fr')
            ->cc('alfred@eni.fr')
            ->replyTo('gordon@eni.fr')
            ->subject('Le joker est revenu')
            ->html('<a href="https://fr.wikipedia.org/wiki/Joker_(personnage)#:~:text=Le%20Joker%20est%20un%20personnage,o%201%2C%20au%20printemps%201940.">Joker</a>');
        $this->mailer->send($email);
    }
}