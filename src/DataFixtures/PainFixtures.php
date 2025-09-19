<?php

namespace App\DataFixtures;

use App\Entity\Pain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PainFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pains = ['Brioché', 'Sésame', 'Sans gluten'];

        foreach ($pains as $type) {
            $pain = new Pain();
            $pain->setType($type);
            $manager->persist($pain);
        }

        $manager->flush();
    }
}
