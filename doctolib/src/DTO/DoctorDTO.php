<?php

namespace App\DTO;

use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *     description="DoctorDTO model",
 *     title="DoctorDTO model"
 * )
 */

class DoctorDTO
{

    /**
     * @OA\Property(
     *     format="integer",
     *     description="ID",
     *     title="ID",
     * )
     * @var null
     */
    private $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="email",
     *     title="email",
     * )
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     format="string",
     *     description="password",
     *     title="password",
     * )
     * @var string
     */
    private $password;

    /**
     * @OA\Property(
     *     format="string",
     *     description="lastName",
     *     title="lastName",
     * )
     * @var string
     */
    private $lastName;

    /**
     * @OA\Property(
     *     format="string",
     *     description="firstName",
     *     title="firstName",
     * )
     * @var string
     */
    private $firstName;

    /**
     * @OA\Property(
     *     format="string",
     *     description="specialty",
     *     title="specialty",
     * )
     * @var string
     */
    private $specialty;

    /**
     * @OA\Property(
     *     format="integer",
     *     description="addressNum",
     *     title="addressNum",
     * )
     * @var int
     */
    private $addressNum;

    /**
     * @OA\Property(
     *     format="string",
     *     description="addressStreet",
     *     title="addressStreet",
     * )
     * @var string
     */
    private $addressStreet;

    /**
     * @OA\Property(
     *     format="integer",
     *     description="postalCodeAddress",
     *     title="postalCodeAddress",
     * )
     * @var int
     */
    private $postalCodeAddress;

    /**
     * @OA\Property(
     *     format="string",
     *     description="townAddress",
     *     title="townAddress",
     * )
     * @var string
     */
    private $townAddress;

    /**
     * @OA\Property(
     *     format="string",
     *     description="profil",
     *     title="profil",
     * )
     * @var string
     */
    private $profil;


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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of specialty
     */
    public function getSpecialty()
    {
        return $this->specialty;
    }

    /**
     * Set the value of specialty
     *
     * @return  self
     */
    public function setSpecialty($specialty)
    {
        $this->specialty = $specialty;

        return $this;
    }

    /**
     * Get the value of addressNum
     */
    public function getAddressNum()
    {
        return $this->addressNum;
    }

    /**
     * Set the value of addressNum
     *
     * @return  self
     */
    public function setAddressNum($addressNum)
    {
        $this->addressNum = $addressNum;

        return $this;
    }

    /**
     * Get the value of addressStreet
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * Set the value of addressStreet
     *
     * @return  self
     */
    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    /**
     * Get the value of postalCodeAddress
     */
    public function getPostalCodeAddress()
    {
        return $this->postalCodeAddress;
    }

    /**
     * Set the value of postalCodeAddress
     *
     * @return  self
     */
    public function setPostalCodeAddress($postalCodeAddress)
    {
        $this->postalCodeAddress = $postalCodeAddress;

        return $this;
    }

    /**
     * Get the value of townAddress
     */
    public function getTownAddress()
    {
        return $this->townAddress;
    }

    /**
     * Set the value of townAddress
     *
     * @return  self
     */
    public function setTownAddress($townAddress)
    {
        $this->townAddress = $townAddress;

        return $this;
    }

    /**
     * Get the value of profil
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set the value of profil
     *
     * @return  self
     */
    public function setProfil(string $profil)
    {
        $this->profil = $profil;

        return $this;
    }
}
