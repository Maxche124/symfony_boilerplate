<?php

namespace App\Controller;

use App\Entity\Sauce;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SauceController extends AbstractController
{
    #[Route('/sauces', name: 'sauce_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sauces = $entityManager->getRepository(Sauce::class)->findAll();

        return $this->render('sauce/list.html.twig', [
            'sauces' => $sauces,
        ]);
    }

    #[Route('/sauce/create', name: 'sauce_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $sauce = new Sauce();
        $sauce->setName('Ketchup');

        // Persister et sauvegarder la nouvelle sauce
        $entityManager->persist($sauce);
        $entityManager->flush();

        return new Response('Sauce créée avec succès !');
    }
}
