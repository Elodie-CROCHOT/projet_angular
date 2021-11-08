<?php

namespace App\Service;

use App\DTO\DoctorDTO;
use App\Entity\Doctor;
use App\Mapper\DoctorMapper;
use App\Repository\DoctorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;
use App\Service\Exception\DoctorServiceException;

class DoctorService
{

    private $repository;
    private $doctorMapper;
    private $entityManager;

    public function __construct(DoctorRepository $repository, DoctorMapper $doctorMapper, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->doctorMapper = $doctorMapper;
        $this->entityManager = $entityManager;
    }

    public function searchBySpecialty(string $specialty)
    {
        try {
            $doctorArray = $this->repository->searchBySpecialty($specialty);
            $doctorDtos = [];
            foreach ($doctorArray as $key => $value) {
                $doctor = (new Doctor);
                $doctor->setId($doctorArray[$key]->getId($value))
                    ->setEmail($doctorArray[$key]->getEmail($value))
                    ->setPassword($doctorArray[$key]->getPassword($value))
                    ->setLastName($doctorArray[$key]->getLastName($value))
                    ->setFirstName($doctorArray[$key]->getFirstName($value))
                    ->setSpecialty($doctorArray[$key]->getSpecialty($value))
                    ->setAddressNum($doctorArray[$key]->getAddressNum($value))
                    ->setAddressStreet($doctorArray[$key]->getAddressStreet($value))
                    ->setPostalCodeAddress($doctorArray[$key]->getPostalCodeAddress($value))
                    ->setTownAddress($doctorArray[$key]->getTownAddress($value))
                    ->setProfil($doctorArray[$key]->getProfil($value));
                $doctorDtos[] = $this->doctorMapper->transformeDoctorEntityToDoctorDto($doctor);
            }
            return $doctorDtos;
        } catch (DriverException $e) {
            throw new DoctorServiceException("Un problème technique est survenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchByEmail(string $email, $password)
    {
        try {
            $doctorArray = $this->repository->searchByEmail($email, $password);
            $doctorDtos = [];
            foreach ($doctorArray as $key => $value) {
                $doctor = (new Doctor);
                $doctor->setId($doctorArray[$key]->getId($value))
                    ->setEmail($doctorArray[$key]->getEmail($value))
                    ->setPassword($doctorArray[$key]->getPassword($value))
                    ->setLastName($doctorArray[$key]->getLastName($value))
                    ->setFirstName($doctorArray[$key]->getFirstName($value))
                    ->setSpecialty($doctorArray[$key]->getSpecialty($value))
                    ->setAddressNum($doctorArray[$key]->getAddressNum($value))
                    ->setAddressStreet($doctorArray[$key]->getAddressStreet($value))
                    ->setPostalCodeAddress($doctorArray[$key]->getPostalCodeAddress($value))
                    ->setTownAddress($doctorArray[$key]->getTownAddress($value))
                    ->setProfil($doctorArray[$key]->getProfil($value));
                $doctorDtos[] = $this->doctorMapper->transformeDoctorEntityToDoctorDto($doctor);
            }
            return $doctorDtos;
        } catch (DriverException $e) {
            throw new DoctorServiceException("Un problème technique est survenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchAll()
    {
        try {
            $doctors = $this->repository->findAll();
            $doctorDtos = [];
            foreach ($doctors as $doctor) {
                $doctorDtos[] = $this->doctorMapper->transformeDoctorEntityToDoctorDto($doctor);
            }
            return $doctorDtos;
        } catch (DriverException $e) {
            throw new DoctorServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function searchById(int $id)
    {
        try {
            $doctor = $this->repository->find($id);
            return $this->doctorMapper->transformeDoctorEntityToDoctorDto($doctor);
        } catch (DriverException $e) {
            throw new DoctorServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function delete(Doctor $doctor)
    {
        try {
            $this->entityManager->remove($doctor);
            $this->entityManager->flush();
        } catch (DriverException $e) {
            throw new DoctorServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function persist(Doctor $doctor, DoctorDTO $doctorDto)
    {
        try {
            $doctor = $this->doctorMapper->transformeDoctorDtoToDoctorEntity($doctorDto, $doctor);
            $this->entityManager->persist($doctor);
            $this->entityManager->flush();
        } catch (DriverException $e) {
            throw new DoctorServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }


}
