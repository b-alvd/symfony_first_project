<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Article;
use App\Entity\User;
use DateTime;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const NAME_CATEGORY = ["Films", "Séries", "Jeux vidéos", "Infos"];

    public function load(ObjectManager $manager, ): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $arrayCategory = [];

        foreach (self::NAME_CATEGORY as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $arrayCategory[] = $category;
        }
        for ($i = 0; $i < 50; $i++) {
            $article = new Article();
            $article->setTitle($faker->realText(50))
                ->setContent($faker->realTextBetween(250, 500))
                ->setCreatedAt($faker->dateTimeBetween('-2 years'))
                ->setVisible($faker->boolean())
                ->setCategory($faker->randomElement($arrayCategory));
            $manager->persist($article);
        }


        $user = new User();
        $user 
            ->setEmail('bobby@gmail.com')
            ->setPassword('bobby');

        $manager->persist($user);

        $admin = new User();
        $admin 
            ->setEmail('admin_bobby@gmail.com')
            ->setPassword('bobby')
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $apiToken = new ApiToken();
        $apiToken->setToken('nZ21wWWmHfF5e');

        $manager->persist($apiToken);


        $manager->flush();
    }
}
