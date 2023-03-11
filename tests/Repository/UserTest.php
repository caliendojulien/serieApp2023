<?php

namespace App\Tests\Repository;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{

    private ObjectManager $entityManager;

    public function testAjoutSuppUtilisateur(): void
    {
        $nbUtilisateurs = count($this->entityManager->getRepository(User::class)->findAll());
        $nouvelUtilisateur = (new User())
            ->setEmail('nouveau@eni.fr')
            ->setPassword('$2y$13$mD5O/di4/RjFxQBWLrPNvO8JkPq9oSUt8pi0jBqv3IeM4w2GA/..u');
        $this->entityManager->getRepository(User::class)->save($nouvelUtilisateur, true);
        $this->assertSame($nbUtilisateurs + 1, count($this->entityManager->getRepository(User::class)->findAll()));
        $this->entityManager->getRepository(User::class)->remove($nouvelUtilisateur, true);
        $this->assertSame($nbUtilisateurs, count($this->entityManager->getRepository(User::class)->findAll()));
    }

    public function testMajMdp(): void
    {
        $utilisateur = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => 'caliendo@eni.fr'
        ]);
        $ancienMDP = $utilisateur->getPassword();
        $this->entityManager->getRepository(User::class)->upgradePassword($utilisateur, '456789');
        $utilisateur = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => 'caliendo@eni.fr'
        ]);
        $this->assertNotSame($ancienMDP, $utilisateur->getPassword());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }
}
