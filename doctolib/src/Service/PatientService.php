<?php

namespace App\Service;

use App\DTO\PatientDTO;
use App\Entity\Patient;
use App\Mapper\PatientMapper;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;
use App\Service\Exception\PatientServiceException;

class PatientService
{

    private $repository;
    private $patientMapper;
    private $entityManager;

    public function __construct(PatientRepository $repository, PatientMapper $patientMapper, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->patientMapper = $patientMapper;
        $this->entityManager = $entityManager;
    }

    public function searchPatientsByName(string $lastname)
    {
        try {
            $patientArray = $this->repository->searchPatientsByName($lastname);
            $patientDtos = [];
            foreach ($patientArray as $key => $value) {
                $patient = (new Patient);
                $patient->setId($patientArray[$key]->getId($value))
                    ->setEmail($patientArray[$key]->getEmail($value))
                    ->setPassword($patientArray[$key]->getPassword($value))
                    ->setLastName($patientArray[$key]->getLastName($value))
                    ->setFirstName($patientArray[$key]->getFirstName($value))
                    ->setBirthDate($patientArray[$key]->getBirthDate($value))
                    ->setAddressNum($patientArray[$key]->getAddressNum($value))
                    ->setAddressStreet($patientArray[$key]->getAddressStreet($value))
                    ->setPostalCodeAddress($patientArray[$key]->getPostalCodeAddress($value))
                    ->setTownAddress($patientArray[$key]->getTownAddress($value))
                    ->setProfil($patientArray[$key]->getProfil($value));
                $patientDtos[] = $this->patientMapper->transformePatientEntityToPatientDto($patient);
            }
            return $patientDtos;
        } catch (DriverException $e) {
            throw new PatientServiceException("Un problème technique est survenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchByEmail(string $email, $password)
    {
        try {
            $patientArray = $this->repository->searchByEmail($email, $password);
            $patientDtos = [];
            foreach ($patientArray as $key => $value) {
                $patient = (new Patient);
                $patient->setId($patientArray[$key]->getId($value))
                    ->setEmail($patientArray[$key]->getEmail($value))
                    ->setPassword($patientArray[$key]->getPassword($value))
                    ->setLastName($patientArray[$key]->getLastName($value))
                    ->setFirstName($patientArray[$key]->getFirstName($value))
                    ->setBirthDate($patientArray[$key]->getBirthDate($value))
                    ->setAddressNum($patientArray[$key]->getAddressNum($value))
                    ->setAddressStreet($patientArray[$key]->getAddressStreet($value))
                    ->setPostalCodeAddress($patientArray[$key]->getPostalCodeAddress($value))
                    ->setTownAddress($patientArray[$key]->getTownAddress($value))
                    ->setProfil($patientArray[$key]->getProfil($value));
                $patientDtos[] = $this->patientMapper->transformePatientEntityToPatientDto($patient);
            }
            return $patientDtos;
        } catch (DriverException $e) {
            throw new PatientServiceException("Un problème technique est survenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchAll()
    {
        try {
            $patients = $this->repository->findAll();
            $patientDtos = [];
            foreach ($patients as $patient) {
                $patientDtos[] = $this->patientMapper->transformePatientEntityToPatientDto($patient);
            }
            return $patientDtos;
        } catch (DriverException $e) {
            throw new PatientServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function searchById(int $id)
    {
        try {
            $patient = $this->repository->find($id);
            return $this->patientMapper->transformePatientEntityToPatientDto($patient);
        } catch (DriverException $e) {
            throw new PatientServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function deletePatient(Patient $patient)
    {
        try {
            $this->entityManager->remove($patient);
            $this->entityManager->flush();
        } catch (DriverException $e) {
            throw new PatientServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function persistPatient(Patient $patient, PatientDTO $patientDto)
    {
        try {
            $patient = $this->patientMapper->transformePatientDtoToPatientEntity($patientDto, $patient);
            $this->entityManager->persist($patient);
            $this->entityManager->flush();
        } catch (DriverException $e) {
            throw new PatientServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }
}
