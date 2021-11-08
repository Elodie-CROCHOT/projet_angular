<?php

namespace App\Tests\Entity;

use \DateTime;
use App\Entity\Appointment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppointmentTest extends KernelTestCase
{
    private $validator;

    protected function setUp()
    {
        self::bootKernel();
        $this->validator = self::$container->get("validator");
    }

    private function getAppointment(){
        return new Appointment();
    }

    public function testGetterAndSetterDateAppointment(){
        $test = new DateTime();
        $appointment = $this->getAppointment();
        $appointment->setDateAppointment($test);
        $this->assertEquals($test, $appointment->getDateAppointment());
    }

    public function testGetterAndSetterHourAppointment(){
        $test = new DateTime();
        $test->setTime(12, 23);
        $appointment = $this->getAppointment();
        $appointment->setHourAppointment($test);
        $this->assertEquals($test, $appointment->getHourAppointment());
    }

    
    public function testIsNotBlankValidator(){
        $appointment = $this->getAppointment();
        $appointment->setDateAppointment(null)->setHourAppointment(null);
        $errors = $this->validator->validate($appointment);
        $this->assertCount(2, $errors);
    }

}