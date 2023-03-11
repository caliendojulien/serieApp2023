<?php

namespace App\Tests\Entity;

use App\Entity\ResetPasswordRequest;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ResetPasswordRequestTest extends TestCase
{

    private ResetPasswordRequest $rpr;

    public function testGettersEtSetters(): void
    {
        $this->assertNull($this->rpr->getId());
        $this->assertNotNull($this->rpr->getUser());
        $this->assertNotNull($this->rpr->getRequestedAt());
        $this->assertNotNull($this->rpr->getExpiresAt());
        $this->assertNotNull($this->rpr->getHashedToken());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->rpr = new ResetPasswordRequest(
            new User(),
            new \DateTime(),
            'abc',
            'xyz'
        );
    }
}
