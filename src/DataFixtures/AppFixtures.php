<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Style;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        
        $faker = Faker\Factory::create();



        for ($i=0; $i < 3; $i++) { 

            $style = new Style();
            $style->setName($faker->unique()->randomElement($array = array ('Metal','Country','Jigg')))
            ;
            $manager->persist($style);
        
            for ($g=0; $g < 10; $g++) { 
            
            $artist = new Artist();
            $artist->setName($faker->name())
            ->setPicture('https://source.unsplash.com/random/900x500')
            ->setStyle($style)
            ;
            $manager->persist($artist);

            for ($j=0; $j < rand(1,10); $j++) { 
                $album = new Album();
                $album->setName($faker->word())
                ->setReleaseYear($faker->numberBetween(2000,2020))
                ->setCover('https://source.unsplash.com/random/900x500')
                ->setArtist($artist)
                ;
                $manager->persist($album);
            }
        }
    }

            $user = new User();
             $user
             ->setEmail("admin@test.fr")
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'admin')
            );
    $manager->persist($user);
            
            $user = new User();
            $user
            ->setEmail("user@test.fr")
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'user')
   );
$manager->persist($user);
            
    $manager->flush();
        $manager->flush();
}
}