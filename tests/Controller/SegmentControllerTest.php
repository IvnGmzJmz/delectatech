<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SegmentControllerTest extends WebTestCase
{
    public function testListSegments()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testShowSegmentDetails()
    {
        $client = static::createClient();
        $client->request('GET', '/segment/1'); // Reemplaza '1' con un ID existente

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testCreateSegment()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/segment/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('form[name="segment_create"]')->count());

        $form = $crawler->filter('form[name="segment_create"]')->form([
            'segment_create[name]' => 'Nuevo Segmento',
            'segment_create[restaurants]' => [1, 2, 3], 
        ]);

        $client->submit($form);


        $this->assertTrue($client->getResponse()->isRedirect('/'));
    }

    public function testEditSegment()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/segment/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('form[name="segment"]')->count());

        $form = $crawler->filter('form[name="segment"]')->form([
            'segment[name]' => 'Segmento Actualizado',
            'segment[restaurants]' => [4, 5, 6], 
        ]);

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect('/')); 
    }

}
