<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     */
    private $dateAppointment;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     */
    private $hourAppointment;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="appointment")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=Doctor::class, inversedBy="appointment")
     */
    private $doctor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDateAppointment(): string
    {
        return $this->dateAppointment;
    }

    public function setDateAppointment(string $dateAppointment): self
    {
        $this->dateAppointment = $dateAppointment;

        return $this;
    }

    public function getHourAppointment(): string
    {
        return $this->hourAppointment;
    }

    public function setHourAppointment(string $hourAppointment): self
    {
        $this->hourAppointment = $hourAppointment;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }
}
