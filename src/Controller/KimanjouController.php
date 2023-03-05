<?php

namespace App\Controller;

use App\Entity\History;
use App\Form\KimanjouType;
use App\Repository\HistoryRepository;
use App\Repository\LocationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KimanjouController extends AbstractController
{
    #[Route('/', name: 'app_kimanjou', methods: ['GET', 'POST'])]
    public function index(HistoryRepository $historyRepository, UserRepository $userRepository): Response
    {
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $histories = [[]];
        $users = $userRepository->findAll();
        $week = [];

        foreach ($days as $keyDay => $day) {
            $date = new \DateTime('this week');
            $date->modify("+ " . ($keyDay) . " day")->setTime(0, 0);
            $week[$keyDay] = $date;

            foreach ($users as $keyUser => $user) {
                $histories[$keyDay][$keyUser] = $historyRepository->findOneBy(['user' => $user, 'date' => $date]);
            }
        }

        return $this->render('kimanjou/index.html.twig', [
            'controller_name' => 'KimanjouController',
            'days' => $days,
            'histories' => $histories,
            'users' => $userRepository->findAll(),
            'week' => $week
        ]);
    }

    #[Route('/kimanjou/{id}/edit', name: 'app_kimanjou_edit', methods: ['GET', 'POST'])]
    public function edit(HistoryRepository $historyRepository, LocationRepository $locationRepository, Request $request, UserRepository $userRepository): Response
    {

        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $histories = [[]];
        $user = $userRepository->find($this->getUser());
        $users = $userRepository->findAll();
        $week = [];

        foreach ($days as $keyDay => $day) {
            $date = new \DateTime('this week');
            $date->modify("+ " . ($keyDay) . " day")->setTime(0, 0);
            $week[$keyDay] = $date;

            foreach ($users as $key => $value) {
                $histories[$keyDay][$key] = $historyRepository->findOneBy(['user' => $value, 'date' => $date]);
            }

            $form = $this->createForm(KimanjouType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $location = $locationRepository->find($form->get('jour' . ($keyDay + 1))->getData());
                $userInBdd = false;

                if ($historyRepository->findOneBy(['user' => $user, 'date' => $week[$keyDay]])) {
                    $history = $historyRepository->findOneBy(['user' => $user, 'date' => $week[$keyDay]]);
                    $userInBdd = true;
                } else {
                    $history = new History();
                    $history->setUser($user);
                    $history->setDate($form->get('date' . ($keyDay + 1))->getData());
                }

                $history->setLocation($location);

                if ($location->getId() == 1 && $userInBdd) {
                    $historyRepository->remove($history, true);
                }

                if ($location->getId() != 1) {
                    $historyRepository->add($history, true);
                }

                if ($keyDay == count($days) - 1) {
                    return $this->redirectToRoute('app_kimanjou_edit', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
                }
            }
        }

        return $this->renderForm('kimanjou/edit.html.twig', [
            'days' => $days,
            'histories' => $histories,
            'kimanjouForm' => $form,
            'users' => $userRepository->findAll(),
            'week' => $week
        ]);
    }
}
