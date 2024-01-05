<?php

namespace Tests\Domain\Entity;

use App\Tests\ParentTestCase;
use Domain\Entity\Segment;
use Domain\Entity\Restaurant;

class SegmentTest extends ParentTestCase
{
    /** @var string */
    const SEGMENT_INPUT_PATH = 'Domain/Entity/segment/inputs/';
    /** @var string */
    const SEGMENT_OUTPUT_PATH = 'Domain/Entity/segment/outputs/';

    /**
     * Implements setUp of PHPUnit
     */
    protected function setUp(): void
    {
        $this->inputResourceMiddlePath = self::SEGMENT_INPUT_PATH;
        $this->outputResourceMiddlePath = self::SEGMENT_OUTPUT_PATH;
    }

    /**
     * Test Getters and Setters of Segment Entity
     */
    public function testSegmentEntityGettersAndSetters()
    {

        $entity = new Segment();

        $entity->setName('Test Name');
        $this->assertEquals('Test Name', $entity->getName());

        $testDateTime = new \DateTime();

        $entity->setCreatedAt($testDateTime);
        $this->assertEquals($testDateTime, $entity->getCreatedAt());

        $entity->setDeletedAt($testDateTime);
        $this->assertEquals($testDateTime, $entity->getDeletedAt());

        $entity->setAveragePopularityRate(10.0);
        $this->assertEquals(10.0, $entity->getAveragePopularityRate());

        $entity->setAverageSatisfactionRate(10.0);
        $this->assertEquals(10.0, $entity->getAverageSatisfactionRate());

        $entity->setAveragePrice(12.5);
        $this->assertEquals(12.5, $entity->getAveragePrice());

        $entity->setTotalReviews(11);
        $this->assertEquals(11, $entity->getTotalReviews());


        $restaurant = new Restaurant();
        $entity->addRestaurant($restaurant);
        $this->assertTrue($entity->getRestaurants()->contains($restaurant));

        $entity->removeRestaurant($restaurant);
        $this->assertFalse($entity->getRestaurants()->contains($restaurant));
    }


    public function testRecalculateAverages()
    {
        $entity = new Segment();

        $restaurant1 = $this->createMock(Restaurant::class);
        $restaurant1->method('getAveragePrice')->willReturn(20.0);
        $restaurant1->method('getSatisfactionRate')->willReturn(4.0);
        $restaurant1->method('getPopularityRate')->willReturn(8.0);
        $restaurant1->method('getTotalReviews')->willReturn(10);

        $restaurant2 = $this->createMock(Restaurant::class);
        $restaurant2->method('getAveragePrice')->willReturn(30.0);
        $restaurant2->method('getSatisfactionRate')->willReturn(5.0);
        $restaurant2->method('getPopularityRate')->willReturn(9.0);
        $restaurant2->method('getTotalReviews')->willReturn(15);

        $entity->addRestaurant($restaurant1);
        $entity->addRestaurant($restaurant2);

        $entity->recalculateAverages();

        $this->assertEquals(25, $entity->getAveragePrice());
        $this->assertEquals(4.5, $entity->getAverageSatisfactionRate());
        $this->assertEquals(8.5, $entity->getAveragePopularityRate());
        $this->assertEquals(25, $entity->getTotalReviews());
    }
}
