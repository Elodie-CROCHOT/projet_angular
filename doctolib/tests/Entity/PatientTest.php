<?php

namespace App\Tests\Entity;

use \DateTime;
use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\Appointment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PatientTest extends KernelTestCase{

    private $validator;

    protected function setUp()
    {
        self::bootKernel();
        $this->validator = self::$container->get("validator");
    }

    private function getPatient(){
        return new Patient();
    }

    public function testGetterAndSetterEmail(){
        $patient = $this->getPatient();
        $patient->setEmail('test@test.com');
        $this->assertEquals('test@test.com', $patient->getEmail());
    }

    public function testGetterAndSetterPassword(){
        $patient = $this->getPatient();
        $patient->setPassword('test');
        $this->assertEquals('test', $patient->getPassword());
    }

    public function testGetterAndSetterLastName(){
        $patient = $this->getPatient();
        $patient->setLastName('toto');
        $this->assertEquals('toto', $patient->getLastName());
    }

    public function testGetterAndSetterFirstName(){
        $patient = $this->getPatient();
        $patient->setFirstName('toto');
        $this->assertEquals('toto', $patient->getFirstName());
    }

    public function testGetterAndSetterBirthDate(){
        $test = new DateTime();
        $patient = $this->getPatient();
        $patient->setBirthDate($test);
        $this->assertEquals($test, $patient->getBirthDate());
    }

    public function testGetterAndSetterAddressNum(){
        $patient = $this->getPatient();
        $patient->setAddressNum(1);
        $this->assertEquals(1, $patient->getAddressNum());
    }

    public function testGetterAndSetterAddressStreet(){
        $patient = $this->getPatient();
        $patient->setAddressStreet('rue test');
        $this->assertEquals('rue test', $patient->getAddressStreet());
    }

    public function testGetterAndSetterPostalCodeAddress(){
        $patient = $this->getPatient();
        $patient->setPostalCodeAddress(59000);
        $this->assertEquals(59000, $patient->getPostalCodeAddress());
    }

    public function testGetterAndSetterTownAddress(){
        $patient = $this->getPatient();
        $patient->setTownAddress('test');
        $this->assertEquals('test', $patient->getTownAddress());
    }

    public function testGetEmptyAppointment(){
        $patient = $this->getPatient();
        $this->assertCount(0, $patient->getAppointment());
    }

    public function testGetNotEmptyAndAddAppointment(){
        $patient = $this->getPatient();
        $test=new DateTime();
        $appointment = (new Appointment())->setDateAppointment($test);
        $patient->addAppointment($appointment);
        $this->assertCount(1, $patient->getAppointment());
        $this->assertEquals(null, $appointment->getDoctor());
    }

    public function testRemoveAppointment(){
        $patient = $this->getPatient();
        $test=new DateTime();
        $appointment = (new Appointment())->setDateAppointment($test);
        $patient->addAppointment($appointment);
        $this->assertCount(1, $patient->getAppointment());
        $patient->removeAppointment($appointment);
        $this->assertCount(0, $patient->getAppointment());
        $this->assertEquals(null, $appointment->getDoctor());
    }

    public function testGetEmptyDoctor(){
        $patient = $this->getPatient();
        $this->assertCount(0, $patient->getDoctors());
    }

    public function testGetNotEmptyAndAddDoctor(){
        $patient = $this->getPatient();
        $doctor = (new Doctor())->setLastName('test');
        $patient->addDoctor($doctor);
        $this->assertCount(1, $patient->getDoctors());
    }

    public function testRemoveDoctor(){
        $patient = $this->getPatient();
        $doctor = (new Doctor())->setLastName('test');
        $patient->addDoctor($doctor);
        $this->assertCount(1, $patient->getDoctors());
        $patient->removeDoctor($doctor);
        $this->assertCount(0, $patient->getDoctors());
    }

    public function testIsNotBlankValidator(){
        $patient = $this->getPatient();
        $patient->setEmail('')->setPassword('')->setLastName('')
                ->setFirstName('')->setBirthDate(null)->setAddressNum(null)
                ->setAddressStreet('')->setPostalCodeAddress(null)->setTownAddress('');
        $errors = $this->validator->validate($patient);
        $this->assertCount(9, $errors);
    }

    public function testIsNotBlankAndIsPositiveValidator(){
        $patient = $this->getPatient();
        $patient->setEmail('')->setPassword('')->setLastName('')
                ->setFirstName('')->setBirthDate(null)->setAddressNum(-2)
                ->setAddressStreet('')->setPostalCodeAddress(-59100)->setTownAddress('');
        $errors = $this->validator->validate($patient);
        $this->assertCount(9, $errors);
    }

    public function testIsNotBlankAndEmailValidator(){
        $patient = $this->getPatient();
        $patient->setEmail('test')->setPassword('')->setLastName('')
                ->setFirstName('')->setBirthDate(null)->setAddressNum(null)
                ->setAddressStreet('')->setPostalCodeAddress(null)->setTownAddress('');
        $errors = $this->validator->validate($patient);
        $this->assertCount(9, $errors);
    }



}