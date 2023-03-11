<?php

namespace App\Tests\Security;

use App\Security\AppAuthenticator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AppAuthenticatorTest extends WebTestCase
{

    public function testAuthenticate(): void
    {
        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $request = $this->createMock(Request::class);
        $request->request = $this->createMock(Request::class);
        // getEmail, getPassword et getCsrfToken
        $request->request->expects(self::exactly(3))
            ->method('get')
            ->willReturn('caliendo@eni.fr');
        $authentification = new AppAuthenticator($urlGenerator);
        $authentification->authenticate($request);
    }
}
