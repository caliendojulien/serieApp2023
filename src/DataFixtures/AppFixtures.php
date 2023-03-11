<?php

namespace App\DataFixtures;

use App\Factory\ResetPasswordRequestFactory;
use App\Factory\SeasonFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // lit le fichier .sql qui est juste à côté
//        $sql = file_get_contents(__DIR__ . "/datas.sql");
        //exécute la requête
//        $manager->getConnection()->exec($sql);
        UserFactory::createMany(10);
        UserFactory::createOne([
            'email' => 'caliendo@eni.fr',
            'password' => '$2y$13$mD5O/di4/RjFxQBWLrPNvO8JkPq9oSUt8pi0jBqv3IeM4w2GA/..u',
            'roles' => []
        ]);
        UserFactory::createOne([
            'email' => 'admin@eni.fr',
            'password' => '$2y$13$mD5O/di4/RjFxQBWLrPNvO8JkPq9oSUt8pi0jBqv3IeM4w2GA/..u',
            'roles' => ['ROLE_ADMIN']
        ]);
        SeasonFactory::createMany(10);
        ResetPasswordRequestFactory::createOne();
    }
}
