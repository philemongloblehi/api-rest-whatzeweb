<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class PhoneFixtures extends Fixture
{
    private $names = ['iPhone', 'Samsung'];
    private $colors = ['black', 'white'];

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $phone = new Phone();
            $phone->setName($this->names[rand(0, 1)] . '' . rand(5, 8));
            $phone->setColor($this->colors[rand(0, 1)]);
            $phone->setPrice(rand(500, 1000));
            $phone->setDescription('A wonderful phone with' .rand(10, 50). 'tricks');

            $manager->persist($phone);
        }

        $manager->flush();
    }
}
