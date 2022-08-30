<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KimanjouController extends AbstractController
{
    #[Route('/kimanjou', name: 'app_kimanjou')]
    public function index(): Response
    {
        return $this->render('kimanjou/index.html.twig', [
            'controller_name' => 'KimanjouController',
        ]);
    }
}
