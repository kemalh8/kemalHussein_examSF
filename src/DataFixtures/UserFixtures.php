<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        
        $testUser1 = new User();
        $testUser1->setfirstName('Ronaldo');
        $testUser1->setlastName('Cristiano');
        $testUser1->setImage('image');
        $testUser1->setEmail('ronaldo@ronaldo.com');
        $encodedPassword = $this->hasher->hashPassword($testUser1, 'ronaldo');
        $testUser1->setPassword($encodedPassword);
        $testUser1->setSector('Computer science');
        $testUser1->setContractType('CDI');
        $testUser1->setRoles(['ROLE_USER']);

        $testUser2 = new User();
        $testUser2->setfirstName('Ozil');
        $testUser2->setlastName('Mesut');
        $testUser2->setImage('image');
        $testUser2->setEmail('ozil@ozil.com');
        $encodedPassword = $this->hasher->hashPassword($testUser2, 'ozil');
        $testUser2->setPassword($encodedPassword);
        $testUser2->setSector('Accounting');
        $testUser2->setContractType('CDD');
        $endDate = \DateTime::createFromFormat('Y-m-d', '2023-10-30');
        $testUser2->setEndDate($endDate);
        $testUser2->setRoles(['ROLE_USER']);

        $testRh = new User();
        $testRh->setfirstName('Kemal');
        $testRh->setlastName('Hussein');
        $testRh->setImage('image');
        $testRh->setEmail('rh@humanbooster.com');
        $encodedPassword = $this->hasher->hashPassword($testRh, 'rh123@');
        $testRh->setPassword($encodedPassword);
        $testRh->setSector('Human-ressources');
        $testRh->setRoles(['ROLE_RH']);

        $manager->persist($testUser1);
        $manager->persist($testUser2);
        $manager->persist($testRh);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
