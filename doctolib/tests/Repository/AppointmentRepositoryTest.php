<?php

namespace App\Tests\Repository;

use \DateTime;
use App\Entity\Appointment;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\AppointmentFixtures;
use App\Repository\AppointmentRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppointmentRepositoryTest extends KernelTestCase
{

    use FixturesTrait;

    private $repository;

    protected function setUp()
    {
        self::bootKernel();
        $this->repository = self::$container->get(AppointmentRepository::class);
    }

    public function testFindAllAppointment(){
        $this->loadFixtures([AppointmentFixtures::class]);
        $appointments = $this->repository->findAll();
        $this->assertCount(5, $appointments);
    }

    public function testFindByAppointment(){
        $this->loadFixtures([AppointmentFixtures::class]);
        $appointments = $this->repository->findBy(["id" => 1]);
        $this->assertCount(1, $appointments);
    }

    public function testFindAppointment(){
        $this->loadFixtures([AppointmentFixtures::class]);
        $appointment = $this->repository->find(1);
        $this->assertNotEmpty($appointment);
    }

    public function testFindOneByAppointment(){
        $this->loadFixtures([AppointmentFixtures::class]);
        $appointment = $this->repository->findOneBy(["id" => 1]);
        $this->assertNotEmpty($appointment);
    }

    public function testPersistAppointmentManager()
    {
        $hourAppointment = new DateTime();
        $hourAppointment->setTime(12, 23);
        $appointment = (new Appointment())->setDateAppointment(new DateTime())->setHourAppointment($hourAppointment);
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($appointment);
        $manager->flush();
        $this->assertCount(1, $this->repository->findAll());
    }

    public function testRemoveAppointmentManager()
    {
        $hourAppointment = new DateTime();
        $hourAppointment->setTime(12, 23);
        $appointment = (new Appointment())->setDateAppointment(new DateTime())->setHourAppointment($hourAppointment);
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($appointment);
        $manager->flush();
        $this->assertCount(1, $this->repository->findAll());
        $manager->remove($this->repository->find(1));
        $manager->flush();
        $this->assertCount(0, $this->repository->findAll());
    }

    protected function tearDown(): void
    {
        $this->loadFixtures([AppFixtures::class]);
    }

}