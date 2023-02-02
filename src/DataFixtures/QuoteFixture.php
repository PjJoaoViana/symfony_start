<?php
namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class QuoteFixture extends Fixture
{

    private Generator $faker;

    public function __construct()
    {

        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getQuote());
        }
        $manager->flush();
    }

    private function getQuote(): Quote
    {

       return (new Quote())
            ->setQuote($this->faker->sentence(10))
            ->setHistorian($this->faker->name())
            ->setYear($this->faker->year());
    }
}