<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\User;
use App\Entity\Brand;
use App\Entity\Address;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 20; $i++) {
            $brand = new Brand();
            $brand->setName("brand".$i);
            $manager->persist($brand);
        }

        for ($i = 0; $i < 20; $i++) {
            $category = new Category();
            $category->setName("category".$i);
            $manager->persist($category);
        }

        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setDescription('description number '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setQuantity(mt_rand(10, 100));
            $date = date("Y-m-d H:i:s");
            $product->setCreatedAt(new \DateTimeImmutable($date));
            $product->setIdBrand($brand);
            $product->addIdCategory($category);
            $manager->persist($product);
        }

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setEmail("test".$i."@test.com");
            $user->setRoles(["ROLE_USER"]);
            $password = $this->encoder->hashPassword($user, 'pass_1234');
            $user->setPassword($password);
            $user->setFirstName("firstname".$i);
            $user->setLastName("lastname".$i);
            $user->setStreetNumber($i);
            $manager->persist($user);
        }

        for ($i = 0; $i < 20; $i++) {
            $city = new City();
            $city->setName("city".$i);
            $manager->persist($city);
        }


        $manager->flush();
    }
}
