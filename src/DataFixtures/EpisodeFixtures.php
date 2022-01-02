<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture
{
    public const EPISODES = [
        array(
            'Title',
            1,
            'Sypnosis',
            1
        ),
    ];

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $value) {
            list($episodeTitle, $episodeNumber, $episodeSypnosis, $episodeSeasonId) = $value;
            $episode = new Episode();
            $episode->setTitle($episodeTitle);

            $slug = $this->slugify->generate($episode->getTitle());
            $episode->setSlug($slug);

            $episode->setNumber($episodeNumber);
            $episode->setSynopsis($episodeSypnosis);
            $manager->persist($episode);
            $this->addReference('episode_' . $key, $episode);
        }
        $manager->flush();
    }
}