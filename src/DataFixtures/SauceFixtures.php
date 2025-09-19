<?php

namespace App\DataFixtures;

use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SauceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sauces = ['Ketchup', 'Mayonnaise', 'Barbecue', 'Moutarde'];

        foreach ($sauces as $name) {
            $sauce = new Sauce();
            $sauce->setName($name);
            $manager->persist($sauce);
        }

        $manager->flush();
    }
}
