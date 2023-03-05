<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile', methods: ['GET'])]
    public function index(User $user): Response
    {
        return $this->render('profile/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profile/{id}/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilePictureFile = $form->get('profilePicture')->getData();

            if ($profilePictureFile) {
                $nameFromEmail = explode( '@', $user->getEmail());
                $originalFileName = pathinfo($nameFromEmail[0], PATHINFO_FILENAME);
                $newFileName = $originalFileName.'.'.$profilePictureFile->guessExtension();

                $profilePictureFile->move(
                    $this->getParameter('profile_pictures_directory'),
                    $newFileName
                );

                $user->setProfilePicture($newFileName);
            }

            $userRepository->add($user, true);

            return $this->redirectToRoute('app_profile', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile/edit.html.twig', [
            'profileForm' => $form,
            'user' => $user,
        ]);
    }
}
