<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Image;
use App\Entity\Pain;
use App\Entity\Oignon;
use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BurgerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $pains = $manager->getRepository(Pain::class)->findAll();
        $oignons = $manager->getRepository(Oignon::class)->findAll();
        $sauces = $manager->getRepository(Sauce::class)->findAll();

        for ($i = 0; $i < 10; $i++) {
            $burger = new Burger();
            $burger->setName($faker->words(2, true));
            $burger->setPrice($faker->randomFloat(2, 5, 20));

            $image = new Image();
            $image->setName($faker->imageUrl(640, 480, 'food'));
            $burger->setImage($image);

            $burger->setPain($faker->randomElement($pains));

            $numOignons = $faker->numberBetween(0, count($oignons));
            for ($j = 0; $j < $numOignons; $j++) {
                $burger->addOignon($faker->randomElement($oignons));
            }

            $numSauces = $faker->numberBetween(0, count($sauces));
            for ($k = 0; $k < $numSauces; $k++) {
                $burger->addSauce($faker->randomElement($sauces));
            }

            $manager->persist($burger);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PainFixtures::class,
            OignonFixtures::class,
            SauceFixtures::class,
        ];
    }
}
