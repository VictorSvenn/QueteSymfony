<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Faker;
use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en-US');

        for ($i = 0; $i< 20; $i++){
            $season = new Season();
            $season->setNumber($i);
            $season->setDescription($faker->text);
            $season->setProgram($this->getReference('program_'.rand(0,5) ));
            $this->addReference('season_'.$i, $season);
            $manager->persist($season);
        }

        $manager->flush();
    }
}