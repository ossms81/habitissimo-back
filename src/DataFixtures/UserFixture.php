<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const USER1_REFERENCE = 'user1';
    public const USER2_REFERENCE = 'user2';
    public const USER3_REFERENCE = 'user3';

    public function load(ObjectManager $manager)
    {
        $user1 = User::create(
            'oscar@oscarsaiz.es',
            '687959457',
            'Mi dirección'
        );
        $manager->persist($user1);

        $user2 = User::create(
            'diegro88@hotmail.com',
            '666666666',
            'General Dávila'
        );
        $manager->persist($user2);

        $user3 = User::create(
            'wmelon84@hotmail.com',
            '777777777',
            'Bezana'
        );
        $manager->persist($user3);

        $manager->flush();

        $this->addReference(self::USER1_REFERENCE, $user1);
        $this->addReference(self::USER2_REFERENCE, $user2);
        $this->addReference(self::USER3_REFERENCE, $user3);
    }
}
