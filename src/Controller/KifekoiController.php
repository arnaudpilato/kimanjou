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
        setlocale(LC_TIME, "fr_FR", "French");
        $week = [];
        for ($i = 0; $i < 7; $i++) {
            $week[$i] = date('l - d/m/Y', strtotime("this week + " . $i . " day"));
        }
        return $this->render('kifekoi/index.html.twig', [
            'controller_name' => 'KifekoiController',
            'week' => $week
        ]);
    }
}
