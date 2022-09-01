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
        setlocale(LC_TIME, "fr_FR", "French");
        $week = [];
        for ($i = 0; $i < 7; $i++) {
            $week[$i] = date('l - d/m/Y', strtotime("this week + " . $i . " day"));
        }

        return $this->render('kimanjou/index.html.twig', [
            'controller_name' => 'KimanjouController',
            'week' => $week
        ]);
    }
}
