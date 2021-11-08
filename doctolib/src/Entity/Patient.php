<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     */
    private $birthDate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\Positive
     */
    private $addressNum;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $addressStreet;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\Positive
     */
    private $postalCodeAddress;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $townAddress;

    /**
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="patient")
     */
    private $appointment;

    /**
     * @ORM\ManyToMany(targetEntity=Doctor::class, mappedBy="patient")
     */
    private $doctors;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profil;

    public function __construct()
    {
        $this->appointment = new ArrayCollection();
        $this->doctors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getAddressNum(): ?int
    {
        return $this->addressNum;
    }

    public function setAddressNum(?int $addressNum): self
    {
        $this->addressNum = $addressNum;

        return $this;
    }

    public function getAddressStreet(): ?string
    {
        return $this->addressStreet;
    }

    public function setAddressStreet(string $addressStreet): self
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    public function getPostalCodeAddress(): ?int
    {
        return $this->postalCodeAddress;
    }

    public function setPostalCodeAddress(?int $postalCodeAddress): self
    {
        $this->postalCodeAddress = $postalCodeAddress;

        return $this;
    }

    public function getTownAddress(): ?string
    {
        return $this->townAddress;
    }

    public function setTownAddress(string $townAddress): self
    {
        $this->townAddress = $townAddress;

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointment(): Collection
    {
        return $this->appointment;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointment->contains($appointment)) {
            $this->appointment[] = $appointment;
            $appointment->setPatient($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointment->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getPatient() === $this) {
                $appointment->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Doctor[]
     */
    public function getDoctors(): Collection
    {
        return $this->doctors;
    }

    public function addDoctor(Doctor $doctor): self
    {
        if (!$this->doctors->contains($doctor)) {
            $this->doctors[] = $doctor;
            $doctor->addPatient($this);
        }

        return $this;
    }

    public function removeDoctor(Doctor $doctor): self
    {
        if ($this->doctors->removeElement($doctor)) {
            $doctor->removePatient($this);
        }

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }
}
