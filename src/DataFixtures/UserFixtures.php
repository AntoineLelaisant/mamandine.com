<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $rowUsers = [
            [
                'firstName' => 'Super',
                'lastName' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => 'admin',
                'roles' => ['ROLE_ADMIN'],
            ],
            [
                'firstName' => 'John',
                'lastName' => 'Doe',
                'email' => 'john.doe@mail.com',
                'password' => 'pass',
                'roles' => ['ROLE_USER'],
            ]
        ];

        foreach ($rowUsers as $rowUser) {
            $user = new User();

            $user->setFirstName($rowUser['firstName']);
            $user->setLastName($rowUser['lastName']);
            $user->setEmail($rowUser['email']);
            $user->setPassword($rowUser['password']);
            $user->setRoles($rowUser['roles']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}

