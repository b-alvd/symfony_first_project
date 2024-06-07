<?php

namespace App\Newsletter;

use App\Entity\NewsletterEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailNotification
{
    public function __construct(private MailerInterface $mailer, private string $adminEmail)
    {
        
    }

    public function sendConfirmationEmail (NewsletterEmail $newEmail): void
    {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($newEmail->getEmail())
            ->subject('Inscription à la Newsletter')
            ->text('Mon gâté ! Merci pour ton inscription à notre Newsletter avec ton email: '.$newEmail->getEmail().'!');
        $this->mailer ->send($email);
    }
}
