<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'app_burger_list')]
    public function list(): Response
    {
        return $this->render('burgers/burgers_list.html.twig');
    }

    #[Route('/burger/{id}', name: 'app_burger_show')]
    public function show(int $id): Response
    {
        return $this->render('burgers/burger_show.html.twig', [
            'id' => $id,
        ]);
    }
}
