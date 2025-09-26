<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CommentaireController extends AbstractController
{
    #[Route('/commentaires', name: 'commentaire_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $commentaires = $entityManager->getRepository(Commentaire::class)->findAll();

        return $this->render('commentaire/list.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }

    #[Route('/commentaire/create', name: 'commentaire_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setAuthor('Squidward');
        $commentaire->setText('This is the worst burger ever!');

        // Find a burger to associate the comment with
        $burger = $entityManager->getRepository(Burger::class)->find(1);

        if (!$burger) {
            return new Response('Burger with id 1 not found!', 404);
        }

        $commentaire->setBurger($burger);

        // Persist and flush the new comment
        $entityManager->persist($commentaire);
        $entityManager->flush();

        return new Response('Commentaire créé avec succès !');
    }
}
