<?php

namespace App\Tests\Repository;

use \DateTime;
use App\Entity\Patient;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\PatientFixtures;
use App\Repository\PatientRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PatientRepositoryTest extends KernelTestCase
{

    use FixturesTrait;

    private $repository;

    protected function setUp()
    {
        self::bootKernel();
        $this->repository = self::$container->get(PatientRepository::class);
    }

    public function testFindAllPatient(){
        $this->loadFixtures([PatientFixtures::class]);
        $patients = $this->repository->findAll();
        $this->assertCount(5, $patients);
    }

    public function testFindByPatient(){
        $this->loadFixtures([PatientFixtures::class]);
        $patients = $this->repository->findBy(["firstName" => 'Test 1']);
        $this->assertCount(1, $patients);
    }

    public function testFindPatient(){
        $this->loadFixtures([PatientFixtures::class]);
        $patient = $this->repository->find(1);
        $this->assertNotEmpty($patient);
    }

    public function testFindOneByPatient(){
        $this->loadFixtures([PatientFixtures::class]);
        $patient = $this->repository->findOneBy(["firstName" => 'Test 1']);
        $this->assertNotEmpty($patient);
    }

    public function testPersistPatientManager()
    {
        $patient = (new Patient())->setEmail("test@test.com")->setPassword("test")->setLastName("Test")
                                    ->setFirstName("Test")->setBirthDate(new DateTime())->setAddressNum(1)
                                    ->setAddressStreet('rue test')->setPostalCodeAddress(1)->setTownAddress('test');
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($patient);
        $manager->flush();
        $this->assertCount(1, $this->repository->findAll());
    }

    public function testRemovePatientManager()
    {
        $patient = (new Patient())->setEmail("test@test.com")->setPassword("test")->setLastName("Test")
                                    ->setFirstName("Test")->setBirthDate(new DateTime())->setAddressNum(1)
                                    ->setAddressStreet('rue test')->setPostalCodeAddress(1)->setTownAddress('test');
        $manager = self::$container->get("doctrine.orm.default_entity_manager");
        $manager->persist($patient);
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