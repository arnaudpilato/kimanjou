<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column]
    private ?string $locationPicture = null;

    #[ORM\Column]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $postCode = null;

    #[ORM\Column]
    private ?string $city = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getLocationPicture(): ?string
    {
        return $this->locationPicture;
    }

    /**
     * @param string|null $locationPicture
     */
    public function setLocationPicture(?string $locationPicture): void
    {
        $this->locationPicture = $locationPicture;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return int|null
     */
    public function getPostCode(): ?int
    {
        return $this->postCode;
    }

    /**
     * @param int|null $postCode
     */
    public function setPostCode(?int $postCode): void
    {
        $this->postCode = $postCode;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }
}
