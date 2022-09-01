<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?Date $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Date|null
     */
    public function getDate(): ?Date
    {
        return $this->date;
    }

    /**
     * @param Date|null $date
     */
    public function setDate(?Date $date): void
    {
        $this->date = $date;
    }
}
