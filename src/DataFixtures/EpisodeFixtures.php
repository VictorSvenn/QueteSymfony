<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use Faker;
use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en-US');

        for ($i = 0; $i<40; $i++){
            $episode = new Episode();
            $episode->setNumber($i);
            $episode->setTitle($faker->word);
            $episode->setSynopsis($faker->text);
            $episode->setSeason($this->getReference('season_'.rand(0,5)));
            $manager->persist($episode);
        }

        $manager->flush();
    }
}