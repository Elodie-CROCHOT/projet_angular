<?php

namespace App\DTO;

use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *     description="AppointmentDTO model",
 *     title="AppointmentDTO model"
 * )
 */

class AppointmentDTO {

    /**
     * @OA\Property(
     *     format="integer",
     *     description="ID",
     *     title="ID",
     * ) 
     * @var int
     */
    private $id;

    /**
     * @OA\Property(
     *     format="\DateTime",
     *     description="dateAppointment",
     *     title="dateAppointment",
     * ) 
     * @var string
     */
    private $dateAppointment;

    /**
     * @OA\Property(
     *     format="\DateTime",
     *     description="hourAppointment",
     *     title="hourAppointment",
     * ) 
     * @var string
     */
    private $hourAppointment;
    
    /**
     * @OA\Property(
     *     format="integer",
     *     description="ID Patient",
     *     title="ID Patient",
     * ) 
     * @var int
     */
    private $idPatient;

    /**
     * @OA\Property(
     *     format="string",
     *     description="Last Name Patient",
     *     title="Last Name Patient",
     * ) 
     * @var string
     */
    private $lastNamePatient;

    /**
     * @OA\Property(
     *     format="string",
     *     description="First Name Patient",
     *     title="First Name Patient",
     * ) 
     * @var string
     */
    private $firstNamePatient;
    
    /**
     * @OA\Property(
     *     format="integer",
     *     description="ID Doctor",
     *     title="ID Doctor",
     * ) 
     * @var int
     */
    private $idDoctor;

    /**
     * @OA\Property(
     *     format="string",
     *     description="Last Name Doctor",
     *     title="Last Name Doctor",
     * ) 
     * @var string
     */
    private $lastNameDoctor;

    /**
     * @OA\Property(
     *     format="string",
     *     description="First Name Doctor",
     *     title="First Name Doctor",
     * ) 
     * @var string
     */
    private $firstNameDoctor;




    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of dateAppointment
     */ 
    public function getDateAppointment()
    {
        return $this->dateAppointment;
    }

    /**
     * Set the value of dateAppointment
     *
     * @return  self
     */ 
    public function setDateAppointment($dateAppointment)
    {
        $this->dateAppointment = $dateAppointment;

        return $this;
    }

    /**
     * Get the value of hourAppointment
     */ 
    public function getHourAppointment()
    {
        return $this->hourAppointment;
    }

    /**
     * Set the value of hourAppointment
     *
     * @return  self
     */ 
    public function setHourAppointment($hourAppointment)
    {
        $this->hourAppointment = $hourAppointment;

        return $this;
    }

    /**
     * Get the value of idPatient
     */ 
    public function getIdPatient()
    {
        return $this->idPatient;
    }

    /**
     * Set the value of idPatient
     *
     * @return  self
     */ 
    public function setIdPatient($idPatient)
    {
        $this->idPatient = $idPatient;

        return $this;
    }

    /**
     * Get the value of idDoctor
     */ 
    public function getIdDoctor()
    {
        return $this->idDoctor;
    }

    /**
     * Set the value of idDoctor
     *
     * @return  self
     */ 
    public function setIdDoctor($idDoctor)
    {
        $this->idDoctor = $idDoctor;

        return $this;
    }

    /**
     * Get the value of lastNamePatient
     */
    public function getLastNamePatient()
    {
        return $this->lastNamePatient;
    }

    /**
     * Set the value of lastNamePatient
     *
     * @return  self
     */
    public function setLastNamePatient(string $lastNamePatient)
    {
        $this->lastNamePatient = $lastNamePatient;

        return $this;
    }

    /**
     * Get the value of firstNamePatient
     */
    public function getFirstNamePatient()
    {
        return $this->firstNamePatient;
    }

    /**
     * Set the value of firstNamePatient
     *
     * @return  self
     */
    public function setFirstNamePatient($firstNamePatient)
    {
        $this->firstNamePatient = $firstNamePatient;

        return $this;
    }

    /**
     * Get the value of lastNameDoctor
     */
    public function getLastNameDoctor()
    {
        return $this->lastNameDoctor;
    }

    /**
     * Set the value of lastNameDoctor
     *
     * @return  self
     */
    public function setLastNameDoctor($lastNameDoctor)
    {
        $this->lastNameDoctor = $lastNameDoctor;

        return $this;
    }

    /**
     * Get the value of firstNameDoctor
     */
    public function getFirstNameDoctor()
    {
        return $this->firstNameDoctor;
    }

    /**
     * Set the value of firstNameDoctor
     *
     * @return  self
     */
    public function setFirstNameDoctor($firstNameDoctor)
    {
        $this->firstNameDoctor = $firstNameDoctor;

        return $this;
    }
}