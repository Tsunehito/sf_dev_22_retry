<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i=1; $i<=10; $i++){
            $article = new Article();
            $article->setTitle($faker->word());
            $article->setContent($faker->paragraphs(4, true));
            $article->setCreatedAt($faker->dateTime());
            $article->setCategory($this->getReference('CAT'.mt_rand(1,5)));
            $article->setAuthor($this->getReference('USER'.mt_rand(1,3)));
            $manager->persist($article);
            $manager->flush();
        }
    }

    public function getDependencies() 
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class
        ];
    }
}
