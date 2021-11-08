<?php

namespace App\DataFixtures;

use \DateTime;
use App\Entity\Appointment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppointmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $hourAppointment = new DateTime();
            $hourAppointment->setTime(12, 23);
            $appointment = (new Appointment())->setDateAppointment(new DateTime())->setHourAppointment($hourAppointment);
            $manager->persist($appointment);
        }

        $manager->flush();
    }
}