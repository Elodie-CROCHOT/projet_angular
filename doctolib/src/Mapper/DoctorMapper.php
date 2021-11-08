<?php

namespace App\Mapper;

use App\DTO\DoctorDTO;
use App\Entity\Doctor;



class DoctorMapper
{

    public function transformeDoctorEntityToDoctorDto(Doctor $doctor)
    {
        $doctorDTO = new DoctorDTO();
        $doctorDTO->setId($doctor->getId());
        $doctorDTO->setEmail($doctor->getEmail());
        $doctorDTO->setPassWord($doctor->getPassWord());
        $doctorDTO->setFirstName($doctor->getFirstName());
        $doctorDTO->setLastName($doctor->getLastName());
        $doctorDTO->setSpecialty($doctor->getSpecialty());
        $doctorDTO->setAddressNum($doctor->getAddressNum());
        $doctorDTO->setAddressStreet($doctor->getAddressStreet());
        $doctorDTO->setPostalCodeAddress($doctor->getPostalCodeAddress());
        $doctorDTO->setTownAddress($doctor->getTownAddress());
        $doctorDTO->setProfil($doctor->getProfil());
        return $doctorDTO;
    }

    public function transformeDoctorDtoToDoctorEntity(DoctorDTO $doctorDTO, Doctor $doctor)
    {

        $doctor->setId(null);
        $doctor->setEmail($doctorDTO->getEmail());
        $doctor->setPassWord($doctorDTO->getPassWord());
        $doctor->setFirstName($doctorDTO->getFirstName());
        $doctor->setLastName($doctorDTO->getLastName());
        $doctor->setSpecialty($doctorDTO->getSpecialty());
        $doctor->setAddressNum($doctorDTO->getAddressNum());
        $doctor->setAddressStreet($doctorDTO->getAddressStreet());
        $doctor->setPostalCodeAddress($doctorDTO->getPostalCodeAddress());
        $doctor->setTownAddress($doctorDTO->getTownAddress());
        $doctor->setProfil('medecin');
        return $doctor;
    }
}
