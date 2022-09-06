<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLocationController extends AbstractController
{
    #[Route('/admin/location', name: 'app_admin_location')]
    public function index(): Response
    {
        return $this->render('admin_location/index.html.twig', [
            'controller_name' => 'AdminLocationController',
        ]);
    }
}
