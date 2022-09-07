<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class KimanjouController extends AbstractController
{
    #[Route('/', name: 'app_kimanjou')]
    public function index(UserRepository $userRepository, LocationRepository $locationRepository, Security $security): Response
    {
        setlocale(LC_TIME, "fr_FR", "French");
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $week = [];
        for ($i = 0; $i < 7; $i++) {
            $week[$i] = date('d/m/Y', strtotime("this week + " . $i . " day"));
        }

        return $this->render('kimanjou/index.html.twig', [
            'controller_name' => 'KimanjouController',
            'week' => $week,
            'users' => $userRepository->findAll(),
            'locations' => $locationRepository->findAll(),
            'userEssai' => $security->getUser(),
            'days' => $days
        ]);
    }
}
