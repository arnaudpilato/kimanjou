<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLocationController extends AbstractController
{
    #[Route('/admin/location', name: 'app_admin_location')]
    public function index(LocationRepository $locationRepository): Response
    {
        return $this->render('admin_location/index.html.twig', [
            'controller_name' => 'AdminLocationController',
            'locations' => $locationRepository->findAll()
        ]);
    }

    #[Route('/admin/location/{id}/edit', name: 'app_admin_location_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Location $location, LocationRepository $locationRepository): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $locationRepository->add($location, true);

            return $this->redirectToRoute('app_admin_location', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_location/edit.html.twig', [
            'location' => $location,
            'locationForm' => $form,
        ]);
    }

    #[Route('/admin/location/{id}', name: 'app_admin_location_delete', methods: ['POST'])]
    public function delete(Request $request, Location $location, LocationRepository $locationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$location->getId(), $request->request->get('_token'))) {
            $locationRepository->remove($location, true);
        }

        return $this->redirectToRoute('app_admin_location', [], Response::HTTP_SEE_OTHER);
    }
}
