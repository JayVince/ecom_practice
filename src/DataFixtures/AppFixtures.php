<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++){
            $product = new Product();
            $product->setName('product '.$i);
            $product->setDescription('description number '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setQuantity(mt_rand(10, 100));
            $date = date("Y-m-d H:i:s");
            $product->setCreatedAt(new \DateTimeImmutable($date));
            $manager->persist($product);
        }


        $manager->flush();
    }
}
