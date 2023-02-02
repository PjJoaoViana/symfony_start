<?php

namespace App\Tests\Controller;
use App\Entity\Quote;
use App\Repository\QuoteRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuoteControllerTest extends WebTestCase
{
    private QuoteRepository $quoteRepositoryMock;

    public function setUp(): void
    {
        parent::setUp();

        $container = self::getContainer();
        $this->quoteRepositoryMock = $this->getMockBuilder(QuoteRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['findAll'])
            ->getMock();

        $container->set('App\Repository\QuoteRepository', $this->quoteRepositoryMock);
    }

    public function testSomeAction(): void
    {
        $client = static::$kernel->getContainer()->get('test.client');

        $this->quoteRepositoryMock->method('findAll')->willReturn([
            (new Quote())->setQuote('some quote')->setYear('2023')->setHistorian('some historian')
        ]);

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}