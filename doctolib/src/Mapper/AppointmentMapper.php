<?php

namespace App\Mapper;

use App\Entity\Doctor;
use App\Entity\Patient;
use App\DTO\AppointmentDTO;
use App\Entity\Appointment;

class AppointmentMapper{

    public function transformeAppointmentEntityToAppointmentDto(Appointment $appointment){
        $appointmentDTO = new AppointmentDTO();
        $appointmentDTO->setId($appointment->getId());
        $appointmentDTO->setDateAppointment($appointment->getDateAppointment());
        $appointmentDTO->setHourAppointment($appointment->getHourAppointment());
        $appointmentDTO->setIdPatient($appointment->getPatient()->getId());
        $appointmentDTO->setIdDoctor($appointment->getDoctor()->getId());
        $appointmentDTO->setLastNamePatient($appointment->getPatient()->getLastName());
        $appointmentDTO->setFirstNamePatient($appointment->getPatient()->getFirstName());
        $appointmentDTO->setLastNameDoctor($appointment->getDoctor()->getLastName());
        $appointmentDTO->setFirstNameDoctor($appointment->getDoctor()->getFirstName());
        return $appointmentDTO;
    }

    public function transformeAppointmentDtoToAppointmentEntity(AppointmentDTO $appointmentDto, Appointment $appointment, Doctor $doctor, Patient $patient){
        $appointment->setDateAppointment($appointmentDto->getDateAppointment());
        $appointment->setHourAppointment($appointmentDto->getHourAppointment());
        $appointment->setPatient($patient);
        $appointment->setDoctor($doctor);
        return $appointment;
    }
}