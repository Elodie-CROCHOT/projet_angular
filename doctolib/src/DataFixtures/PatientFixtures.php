<?php

namespace App\DataFixtures;

use \DateTime;
use App\Entity\Patient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PatientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $patient = (new Patient())->setEmail("test$i@test.com")->setPassword("test")->setLastName("Test $i")
                                    ->setFirstName("Test $i")->setBirthDate(new DateTime())->setAddressNum($i)
                                    ->setAddressStreet('rue test')->setPostalCodeAddress($i)->setTownAddress('test');
            $manager->persist($patient);
        }

        $manager->flush();
    }
}
