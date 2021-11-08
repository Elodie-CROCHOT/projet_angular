<?php

namespace App\DataFixtures;

use App\Entity\Doctor;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DoctorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $doctor = (new Doctor())->setEmail("test$i@test.com")->setPassword("test")->setLastName("Test $i")
                                    ->setFirstName("Test $i")->setSpecialty("test $i")->setAddressNum($i)
                                    ->setAddressStreet('rue test')->setPostalCodeAddress($i)->setTownAddress('test');
            $manager->persist($doctor);
        }

        $manager->flush();
    }
}
