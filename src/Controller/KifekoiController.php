<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KifekoiController extends AbstractController
{
    #[Route('/kifekoi', name: 'app_kifekoi')]
    public function index(): Response
    {
        return $this->render('kifekoi/index.html.twig', [
            'controller_name' => 'KifekoiController',
        ]);
    }
}
