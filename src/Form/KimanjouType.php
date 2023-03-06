<?php

namespace App\Form;

use App\Entity\History;
use App\Entity\Location;
use App\Repository\HistoryRepository;
use App\Repository\LocationRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class KimanjouType extends AbstractType
{
    private HistoryRepository $historyRepository;
    private UserRepository $userRepository;
    private TokenStorageInterface $tokenStorage;
    private LocationRepository $locationRepository;

    public function __construct(UserRepository $userRepository, HistoryRepository $historyRepository, TokenStorageInterface $tokenStorage, LocationRepository $locationRepository) {
        $this->historyRepository = $historyRepository;
        $this->locationRepository = $locationRepository;
        $this->tokenStorage = $tokenStorage;
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $histories = [];
        $user = $this->userRepository->find($this->tokenStorage->getToken()->getUser());
        $week = [];

        for ($i = 0; $i < 7; $i++) {
            $date = new \DateTime('this week');
            $date->modify("+ " . ($i) . " day")->setTime(0, 0);
            $week[$i] = $date;
            $histories[$i] = $this->historyRepository->findOneBy(['user' => $user, 'date' => $date]) ? $this->historyRepository->findOneBy(['user' => $user, 'date' => $date])->getLocation() : $this->locationRepository->findOneBy(['id' => 1]);
        }

        for ($j = 0; $j < count($week); $j++) {
            $builder
                ->add('jour' . $j + 1, EntityType::class, [
                    'choice_label' => 'name',
                    'class' => Location::class,
                    'data' => $histories[$j],
                    'label' => false ,
                    'mapped' => false,
                    'query_builder' => function (LocationRepository $locationRepository) {
                        return $locationRepository->createQueryBuilder('location')
                            ->orderBy('location.name', 'ASC');
                    }
                ])
                ->add('date' . $j + 1, DateType::class, [
                    'attr' => [
                        'hidden' => 'hidden',
                        'disabled' => 'disabled',
                    ],
                    'data' => $week[$j],
                    'label' => false,
                    'mapped' => false
                ]);
        }

        $builder
            ->add('user', HiddenType::class, [
                'data' => $user->getId(),
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => History::class,
        ]);
    }
}
