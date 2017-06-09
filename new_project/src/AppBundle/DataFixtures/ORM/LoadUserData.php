<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('sash');
        $userAdmin->setPassword(password_hash('krialsash', PASSWORD_BCRYPT));

        $manager->persist($userAdmin);
        $manager->flush();
    }
}

//  php bin/console doctrine:fixtures:load --append