<?php

namespace App\DataFixtures;

use App\Entity\Year;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class YearFixtures extends Fixture
{



    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=2009; $i<2020; $i++){
            $year = new Year();
            $year->setTitle($i);
            $this->addReference('Year_'.$i,$year);

            $manager->persist($year);
        }

        $manager->flush();
    }
}
