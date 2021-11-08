<?php

namespace App\DataFixtures;

use App\Repository\PatientRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private $repository;

    public function __construct(PatientRepository $repo)
    {
        $this->repository = $repo;
    }
    
    public function load(ObjectManager $manager)
    {
        $fixtures = $this->repository->findAll();

        foreach ($fixtures as $fixture) {
            $this->manager->remove($fixture);
        }

        $manager->flush();
    }
}
