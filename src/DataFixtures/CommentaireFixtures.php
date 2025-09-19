<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $burgers = $manager->getRepository(Burger::class)->findAll();

        foreach ($burgers as $burger) {
            $numCommentaires = $faker->numberBetween(0, 5);

            for ($i = 0; $i < $numCommentaires; $i++) {
                $commentaire = new Commentaire();
                $commentaire->setAuthor($faker->name());
                $commentaire->setText($faker->text());
                $commentaire->setBurger($burger);

                $manager->persist($commentaire);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BurgerFixtures::class,
        ];
    }
}
