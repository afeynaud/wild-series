<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTORS = array(
        array('Norman', 'Reedus', '1969-01-06'),
        array('Andrew', 'Lincoln', '1976-09-14'),
        array('Lauren', 'Cohan', '1982-01-07'),
        array('Jeffrey', 'Dean Morgan', '1966-04-22'),
        array('Chandler', 'Riggs', '1999-06-27'),
    );

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $value) {
            list($actorFirstname, $actorLastname, $actorsBirthdate) = $value;
            $actor = new Actor();
            $actor->setFirstname($actorFirstname);
            $actor->setLastname($actorLastname);
            $date = new \DateTime($actorsBirthdate);
            $actor->setBirthDate($date);
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
        }
        $manager->flush();
    }
}