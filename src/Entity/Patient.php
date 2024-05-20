<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
#[ApiResource]
class Patient
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $name = null;

  #[ORM\Column(length: 255)]
  private ?string $email = null;

  #[ORM\Column(length: 255)]
  private ?string $phone = null;

  #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Appointment::class)]
  private Collection $appointments;

  public function __construct()
  {
    $this->appointments = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): static
  {
    $this->name = $name;
    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): static
  {
    $this->email = $email;
    return $this;
  }

  public function getPhone(): ?string
  {
    return $this->phone;
  }

  public function setPhone(string $phone): static
  {
    $this->phone = $phone;
    return $this;
  }
  /**
   * @return Collection<int, Appointment>
   */
  public function getAppointments(): Collection
  {
    return $this->appointments;
  }

}
