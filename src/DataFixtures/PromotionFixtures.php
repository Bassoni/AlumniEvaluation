<?php

namespace App\DataFixtures;


use App\Entity\Promotion;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PromotionFixtures extends BaseFixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
                DegreeFixtures::class,
                YearFixtures::class
                ];

    }


    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $degrees=$this->getReferences('Degree');
        $years=$this->getReferences('Year');

        $i=0;

        foreach ($degrees as $degree){

            foreach ($years as $year){

                $promo = new Promotion();
                $promo->setDegree($degree);
                $promo->setYear($year);
                $promo->setStartDate('1 janvier ');
                $promo->setEndDate('24 decembre ');
                $promo->setNotes('cette formation serait geniale ');

                $this->addReference('Promotion_'.$i,$promo);

                $manager->persist($promo);
                $i++;
            }
        }


        $manager->flush();
    }
}
