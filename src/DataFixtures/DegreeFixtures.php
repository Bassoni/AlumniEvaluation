<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DegreeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        //entitées

        $degrees = ['DevWeb', 'WebDesign', 'Electricien', 'TAI'];

        for ($i=0; $i<count($degrees); $i++){

            $degree = new Degree();
            $degree->setName($degrees[$i]);
            $this->addReference('Degree_'.$i,$degree);

            $manager->persist($degree);

        }



    //action de pérsister toute les entitées dans la base de donnée ( persister signifi partir d'entités creer en php pour les creer dans une bdd)
        $manager->flush();
    }
}
