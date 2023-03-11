<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $utilisateur;

    public function testGettersEtSetters(): void
    {
        $this->utilisateur->eraseCredentials(); // Ne fais absolument rien
        $this->assertNull($this->utilisateur->getId());
        $this->assertNotNull($this->utilisateur->getEmail());
        $this->assertNotNull($this->utilisateur->getRoles());
        $this->assertNotNull($this->utilisateur->getPassword());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->utilisateur = (new User())
            ->setEmail('caliendo@eni.fr')
            ->setPassword('123456')
            ->setRoles([]);
    }
}
