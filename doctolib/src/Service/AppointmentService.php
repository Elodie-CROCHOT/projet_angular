<?php

namespace App\Service;

use App\DTO\AppointmentDTO;
use App\Entity\Appointment;
use App\Mapper\AppointmentMapper;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use App\Repository\DoctorRepository;
use App\Repository\PatientRepository;
use Doctrine\DBAL\Exception\DriverException;
use App\Service\Exception\AppointmentServiceException;

class AppointmentService
{

    private $repository;
    private $appointmentMapper;
    private $entityManager;
    private $doctorRepository;
    private $patientRepository;

    public function __construct(AppointmentRepository $repository, AppointmentMapper $appointmentMapper, EntityManagerInterface $entityManager, DoctorRepository $doctorRepository, PatientRepository $patientRepository)
    {
        $this->repository = $repository;
        $this->appointmentMapper = $appointmentMapper;
        $this->entityManager = $entityManager;
        $this->doctorRepository = $doctorRepository;
        $this->patientRepository = $patientRepository;
    }

    // public function searchAppointmentsByPatient($lastname){
    //     try{
    //         $appointments = $this->repository->searchAppointmentByPatient($lastname);
    //         $appointementDtos = [];
    //         foreach($appointments as $key=>$value){
    //                 $appointment = new Appointment;
    //                 $appointment->setId($appointments[$key]->getId($value))
    //                             ->setDateAppointment($appointments[$key]->getDateAppointment($value))
    //                             ->setHourAppointment($appointments[$key]->getHourAppointment($value))
    //                             ->setPatient($appointments[$key]->getDateAppointment($value));
    //         }
    //     } catch (DriverException $e) {
    //         throw new AppointmentServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
    //     }
    // }

    public function searchAllAppointments()
    {
        try {
            $appointments = $this->repository->findAll();
            $appointementDtos = [];
            foreach ($appointments as $appointment) {
                $appointementDtos[] = $this->appointmentMapper->transformeAppointmentEntityToAppointmentDto($appointment);
            }
            return $appointementDtos;
        } catch (DriverException $e) {
            throw new AppointmentServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function searchById(int $id)
    {
        try {
            $appointment = $this->repository->find($id);
            return $this->appointmentMapper->transformeAppointmentEntityToAppointmentDto($appointment);
        } catch (DriverException $e) {
            throw new AppointmentServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function deleteAppointment(Appointment $appointment)
    {
        try {
            $this->entityManager->remove($appointment);
            $this->entityManager->flush();
        } catch (DriverException $e) {
            throw new AppointmentServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function persistAppointment(Appointment $appointment, AppointmentDTO $appointmentDto)
    {
        try {
            $doctor = $this->doctorRepository->find($appointmentDto->getIdDoctor());
            $patient = $this->patientRepository->find($appointmentDto->getIdPatient());
            $appointment = $this->appointmentMapper->transformeAppointmentDtoToAppointmentEntity($appointmentDto, $appointment, $doctor, $patient);
            $this->entityManager->persist($appointment);
            $this->entityManager->flush();
        } catch (DriverException $e) {
            throw new AppointmentServiceException("Un problème technique est survenu. Veuillez rééssayer ultérieurement.", $e->getCode());
        }
    }

    public function searchAppointmentById(int $id)
    {
        try {
            $appointment = $this->repository->find($id);
            return $this->appointmentMapper->transformeAppointmentEntityToAppointmentDto($appointment);
        } catch (DriverException $e) {
            throw new AppointmentServiceException("Un problème technique est survenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }
}
