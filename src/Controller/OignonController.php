<?php

namespace App\Controller;

use App\Entity\Oignon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OignonController extends AbstractController
{
    #[Route('/oignons', name: 'oignon_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $oignons = $entityManager->getRepository(Oignon::class)->findAll();

        return $this->render('oignon/list.html.twig', [
            'oignons' => $oignons,
        ]);
    }

    #[Route('/oignon/create', name: 'oignon_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $oignon = new Oignon();
        $oignon->setName('Oignon rouge');
    
        // Persister et sauvegarder l'oignon
        $entityManager->persist($oignon);
        $entityManager->flush();
    
        return new Response('Oignon créé avec succès !');
    }
}
