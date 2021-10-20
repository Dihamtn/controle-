<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $categorie1 = new Categorie();
        $categorie1->setdesignation("amis");
        $manager->persist($categorie1);

        $categorie2 = new Categorie();
        $categorie2->setdesignation("connaissance");
        $manager->persist($categorie2);
       
        $categorie3 = new Categorie();
        $categorie3->setesignation("professionnel");
        $manager->persist($categorie3);

        $cats = [$categorie1, $categorie2, $categorie3];

        $manager->flush();

        $faker = Factory::create('FR-fr');
       
        for($i = 1; $i <= 30; $i++)
        {
       
            $contact = new Contact();

            $avatar =$faker->imageUrl(80,80);
            $adresse=$faker->address;
            $prenom=$faker->name;
            $nom=$faker->lastName;
            $ville=$faker->city;
            $numero_telephone=$faker->phoneNumber;
            $adresse_email=$faker->email;
            $code_postal=$faker->countryCode;

            $contact->setNom($nom)
                    ->setPrenom($prenom)
                    ->setAdresse($adresse)
                    ->setVille($ville)
                    ->setNumero_telephone($numero_telephone)
                    ->setAdresse_mail($adresse_mail)
                    ->setCode_postal($code_postal)
                    ->setAvatar($image)
                    ->setCategorie($cats[mt_rand(0,2)]);

            $manager->persist($contact);
       
    }
    $manager->flush();
    }
}