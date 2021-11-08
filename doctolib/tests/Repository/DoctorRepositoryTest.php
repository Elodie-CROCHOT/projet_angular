<?php

namespace App\Tests\Repository;

use App\Entity\Doctor;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\DoctorFixtures;
use App\Repository\DoctorRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DoctorRepositoryTest extends KernelTestCase
{

    use FixturesTrait;

    private $repository;

    protected function setUp()
    {
        self::bootKernel();
        $this->repository = self::$container->get(DoctorRepository::class);
    }

    public function testFindAllDoctor(){
        $this->loadFixtures([DoctorFixtures::class]);
        $doctors = $this->repository->findAll();
        $this->assertCount(5, $doctors);
    }

    public function testFindByDoctor(){
        $this->loadFixtures([DoctorFixtures::class]);
        $doctors = $this->repository->findBy(["firstName" => 'Test 1']);
        $this->assertCount(1, $doctors);
    }

    public function testFindDoctor(){
        $this->loadFixtures([DoctorFixtures::class]);
        $doctor = $this->repository->find(1);
        $this->assertNotEmpty($doctor);
    }

    public function testFindOneByDoctor(){
        $this->loadFixtures([DoctorFixtures::class]);
        $doctor = $this->repository->findOneBy(["firstName" => 'Test 1']);
        $this->assertNotEmpty($doctor);
    }

    public function testPersistDoctorManager()
    {
        $doctor = (new Doctor())->setEmail("test@test.com")->setPassword("test")->setLastName("Test")
                                    ->setFirstName("Test")->setSpecialty("test")->setAddressNum(1)
                                    ->setAddressStreet('rue test')->setPostalCodeAddress(1)->setTownAddress('test');
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($doctor);
        $manager->flush();
        $this->assertCount(1, $this->repository->findAll());
    }

    public function testRemoveDoctorManager()
    {
        $doctor = (new Doctor())->setEmail("test@test.com")->setPassword("test")->setLastName("Test")
                                    ->setFirstName("Test")->setSpecialty("test")->setAddressNum(1)
                                    ->setAddressStreet('rue test')->setPostalCodeAddress(1)->setTownAddress('test');
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($doctor);
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