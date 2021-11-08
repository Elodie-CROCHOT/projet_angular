<?php

namespace App\Mapper;

use App\DTO\PatientDTO;
use App\Entity\Patient;



class PatientMapper
{

    public function transformePatientEntityToPatientDto(Patient $patient)
    {
        $patientDTO = new PatientDTO();
        $patientDTO->setId($patient->getId());
        $patientDTO->setEmail($patient->getEmail());
        $patientDTO->setPassWord($patient->getPassWord());
        $patientDTO->setFirstName($patient->getFirstName());
        $patientDTO->setLastName($patient->getLastName());
        $patientDTO->setBirthDate($patient->getBirthDate());
        $patientDTO->setAddressNum($patient->getAddressNum());
        $patientDTO->setAddressStreet($patient->getAddressStreet());
        $patientDTO->setPostalCodeAddress($patient->getPostalCodeAddress());
        $patientDTO->setTownAddress($patient->getTownAddress());
        $patientDTO->setProfil($patient->getProfil());
        return $patientDTO;
    }

    public function transformePatientDtoToPatientEntity(PatientDTO $patientDTO, Patient $patient)
    {

        $patient->setId(null);
        $patient->setEmail($patientDTO->getEmail());
        $patient->setPassWord($patientDTO->getPassWord());
        $patient->setFirstName($patientDTO->getFirstName());
        $patient->setLastName($patientDTO->getLastName());
        $patient->setBirthDate($patientDTO->getBirthDate());
        $patient->setAddressNum($patientDTO->getAddressNum());
        $patient->setAddressStreet($patientDTO->getAddressStreet());
        $patient->setPostalCodeAddress($patientDTO->getPostalCodeAddress());
        $patient->setTownAddress($patientDTO->getTownAddress());
        $patient->setProfil('patient');
        return $patient;
    }
}
