<?php

namespace App\DataFixtures;

use App\Entity\Oignon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OignonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $oignons = ['Oignons rouges', 'Oignons frits', 'Oignons caramélisés'];

        foreach ($oignons as $name) {
            $oignon = new Oignon();
            $oignon->setName($name);
            $manager->persist($oignon);
        }

        $manager->flush();
    }
}
