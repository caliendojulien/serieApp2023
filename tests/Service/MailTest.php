<?php

namespace App\Tests\Service;

use App\Services\MailService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;

class MailTest extends TestCase
{
    public function testEnvoiMail(): void
    {
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->expects(self::once())
            ->method('send');
        $email = new MailService($mailer);
        $email->sendMail();
    }
}
