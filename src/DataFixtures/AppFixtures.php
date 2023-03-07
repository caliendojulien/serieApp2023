<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // lit le fichier .sql qui est juste à côté
        $sql = file_get_contents(__DIR__ . "/datas.sql");

        //exécute la requête
        $manager->getConnection()->exec($sql);
    }
}
