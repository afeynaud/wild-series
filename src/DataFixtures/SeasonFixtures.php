<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        array(
            '1',
            '2010',
            'Saison 1',
            '1'
        ),
        array(
            '1',
            '2010',
            'Saison 1',
            '1'
        ),
        array(
            '1',
            '2010',
            'Saison 1',
            '1'
        ),
        array(
            '1',
            '2010',
            'Saison 1',
            '1'
        ),
        array(
            '1',
            '2010',
            'Saison 1',
            '1'
        ),
        array(
            '1',
            '2010',
            'Saison 1',
            '1'
        ),
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $key => $value) {
            list($seasonId, $seasonYear, $seasonDescription, $seasonNumber) = $value;
            $season = new Season();
            $season->setYear($seasonYear);
            $season->setDescription($seasonDescription);
            $season->setNumber($seasonNumber);
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
            for ($i = 0; $i < count(EpisodeFixtures::EPISODES); $i++) {
                $season->addEpisode($this->getReference('episode_0'));
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EpisodeFixtures::class,
        ];
    }
}