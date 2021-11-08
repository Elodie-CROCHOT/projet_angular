<?php

namespace App\Tests\Entity;

use \DateTime;
use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\Appointment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DoctorTest extends KernelTestCase{

    private $validator;

    protected function setUp()
    {
        self::bootKernel();
        $this->validator = self::$container->get("validator");
    }

    private function getDoctor(){
        return new Doctor();
    }

    public function testGetterAndSetterEmail(){
        $doctor = $this->getDoctor();
        $doctor->setEmail('test@test.com');
        $this->assertEquals('test@test.com', $doctor->getEmail());
    }

    public function testGetterAndSetterPassword(){
        $doctor = $this->getDoctor();
        $doctor->setPassword('test');
        $this->assertEquals('test', $doctor->getPassword());
    }

    public function testGetterAndSetterLastName(){
        $doctor = $this->getDoctor();
        $doctor->setLastName('toto');
        $this->assertEquals('toto', $doctor->getLastName());
    }

    public function testGetterAndSetterFirstName(){
        $doctor = $this->getDoctor();
        $doctor->setFirstName('toto');
        $this->assertEquals('toto', $doctor->getFirstName());
    }

    public function testGetterAndSetterSpecialty(){
        $doctor = $this->getDoctor();
        $doctor->setSpecialty('toto');
        $this->assertEquals('toto', $doctor->getSpecialty());
    }

    public function testGetterAndSetterAddressNum(){
        $doctor = $this->getDoctor();
        $doctor->setAddressNum(1);
        $this->assertEquals(1, $doctor->getAddressNum());
    }

    public function testGetterAndSetterAddressStreet(){
        $doctor = $this->getDoctor();
        $doctor->setAddressStreet('rue test');
        $this->assertEquals('rue test', $doctor->getAddressStreet());
    }

    public function testGetterAndSetterPostalCodeAddress(){
        $doctor = $this->getDoctor();
        $doctor->setPostalCodeAddress(59000);
        $this->assertEquals(59000, $doctor->getPostalCodeAddress());
    }

    public function testGetterAndSetterTownAddress(){
        $doctor = $this->getDoctor();
        $doctor->setTownAddress('test');
        $this->assertEquals('test', $doctor->getTownAddress());
    }

    public function testGetEmptyAppointment(){
        $doctor = $this->getDoctor();
        $this->assertCount(0, $doctor->getAppointment());
    }

    public function testGetNotEmptyAndAddAppointment(){
        $doctor = $this->getDoctor();
        $test=new DateTime();
        $appointment = (new Appointment())->setDateAppointment($test);
        $doctor->addAppointment($appointment);
        $this->assertCount(1, $doctor->getAppointment());
        $this->assertEquals($doctor, $appointment->getDoctor());
    }

    public function testRemoveAppointment(){
        $doctor = $this->getDoctor();
        $test=new DateTime();
        $appointment = (new Appointment())->setDateAppointment($test);
        $doctor->addAppointment($appointment);
        $this->assertCount(1, $doctor->getAppointment());
        $doctor->removeAppointment($appointment);
        $this->assertCount(0, $doctor->getAppointment());
        $this->assertEquals(null, $appointment->getDoctor());
    }

    public function testGetEmptyPatient(){
        $doctor = $this->getDoctor();
        $this->assertCount(0, $doctor->getPatient());
    }

    public function testGetNotEmptyAndAddPatient(){
        $doctor = $this->getDoctor();
        $patient = (new Patient())->setLastName('test');
        $doctor->addPatient($patient);
        $this->assertCount(1, $doctor->getPatient());
    }

    public function testRemovePatient(){
        $doctor = $this->getDoctor();
        $patient = (new Patient())->setLastName('test');
        $doctor->addPatient($patient);
        $this->assertCount(1, $doctor->getPatient());
        $doctor->removePatient($patient);
        $this->assertCount(0, $doctor->getPatient());
    }

    public function testIsNotBlankValidator(){
        $doctor = $this->getDoctor();
        $doctor->setEmail('')->setPassword('')->setLastName('')
                ->setFirstName('')->setSpecialty('')->setAddressNum(null)
                ->setAddressStreet('')->setPostalCodeAddress(null)->setTownAddress('');
        $errors = $this->validator->validate($doctor);
        $this->assertCount(9, $errors);
    }

    public function testIsNotBlankAndIsPositiveValidator(){
        $doctor = $this->getDoctor();
        $doctor->setEmail('')->setPassword('')->setLastName('')
                ->setFirstName('')->setSpecialty('')->setAddressNum(-2)
                ->setAddressStreet('')->setPostalCodeAddress(-59100)->setTownAddress('');
        $errors = $this->validator->validate($doctor);
        $this->assertCount(9, $errors);
    }

    public function testIsNotBlankAndEmailValidator(){
        $doctor = $this->getDoctor();
        $doctor->setEmail('test')->setPassword('')->setLastName('')
                ->setFirstName('')->setSpecialty('')->setAddressNum(null)
                ->setAddressStreet('')->setPostalCodeAddress(null)->setTownAddress('');
        $errors = $this->validator->validate($doctor);
        $this->assertCount(9, $errors);
    }



}