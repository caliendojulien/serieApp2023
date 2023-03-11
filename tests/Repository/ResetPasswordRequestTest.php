<?php

namespace App\Tests\Repository;

use App\Entity\ResetPasswordRequest;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ResetPasswordRequestTest extends KernelTestCase
{
    private ObjectManager $entityManager;

    public function testAjoutSuppRpr(): void
    {
        $nbRpr = count($this->entityManager->getRepository(ResetPasswordRequest::class)->findAll());
        $nouvelUtilisateur = (new User())
            ->setEmail('nouveau@eni.fr')
            ->setPassword('$2y$13$mD5O/di4/RjFxQBWLrPNvO8JkPq9oSUt8pi0jBqv3IeM4w2GA/..u');
        $nouvelleRpr = new ResetPasswordRequest(
            $nouvelUtilisateur,
            \DateTimeImmutable::createFromMutable(new \DateTime()),
            'abc',
            'abc'
        );
        $this->entityManager->getRepository(ResetPasswordRequest::class)->save($nouvelleRpr, true);
        $this->assertSame($nbRpr + 1, count($this->entityManager->getRepository(ResetPasswordRequest::class)->findAll()));
        $this->entityManager->getRepository(ResetPasswordRequest::class)->remove($nouvelleRpr, true);
        $this->assertSame($nbRpr, count($this->entityManager->getRepository(ResetPasswordRequest::class)->findAll()));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }
}
