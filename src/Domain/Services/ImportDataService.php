<?php

namespace Domain\Services;

use Exception;
use DateTime;
use DateTimeZone;
use Domain\Entity\Restaurant;
use Domain\Entity\Segment;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ImportDataService
{

    /** @var EntityManager */
    private $em;

    /**
     * SegmentService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $fileData
     * @return array
     * @throws Exception
     */
    public function importDataFromFile(array $fileData): array
    {
        $totalRests = 0;
        $totalSegments = 0;
        $indexedRestaurants = [];
        foreach ($fileData as $segIndx => $segmentData) {
            // Create Segment entity
            echo "[$segIndx/" . count($fileData) . "]\n";
            $segment = new Segment();
            $segment->setName($segmentData["name"]);
            $segment->setCreatedAt(new DateTime("now", new DateTimeZone("UTC")));
            $segment->setUidentifier(sha1($segmentData["name"]));
            $totalSegments++;
            $totalReviews = 0;
            $popularities = [];
            $satisfactions = [];
            $prices = [];

            foreach ($segmentData["restaruants"] as $restIndx => $restaurantData) {
                echo "[$restIndx/" . count($segmentData["restaruants"]) . "]";
                // generate restaurant uid
                $restUid = sha1($restaurantData["name"] . $restaurantData["street_address"]);
                // accumulate values for segment averages
                $totalReviews += $restaurantData["total_reviews"];
                $popularities[] = (float)$restaurantData["popularity_rate"];
                $satisfactions[] = (float)$restaurantData["satisfaction_rate"];
                $prices[] = (float)$restaurantData["last_avg_price"];
                // if restaurant already created, assign segment and continue
                if (array_key_exists($restUid, $indexedRestaurants)) {
                    $indexedRestaurants[$restUid]->addSegment($segment);
                    continue;
                }
                $totalRests++;
                // create restaurant entity
                $restaurant = new Restaurant();
                $restaurant->setName($restaurantData["name"]);
                $restaurant->setAddress($restaurantData["street_address"]);
                $restaurant->setLatitude((float)$restaurantData["latitude"]);
                $restaurant->setLongitude((float)$restaurantData["longitude"]);
                $restaurant->setCityName($restaurantData["city_name"]);
                $restaurant->setPopularityRate((float)$restaurantData["popularity_rate"]);
                $restaurant->setSatisfactionRate((float)$restaurantData["satisfaction_rate"]);
                $restaurant->setAveragePrice((float)$restaurantData["last_avg_price"]);
                $restaurant->setTotalReviews($restaurantData["total_reviews"]);
                $restaurant->setUidentifier($restUid);
                $indexedRestaurants[$restUid] = $restaurant;
                $restaurant->addSegment($segment);
                $this->em->persist($restaurant);
            }
            // calculate segment averages
            $segment->setTotalReviews($totalReviews);
            $segment->setAveragePrice(array_sum($prices) / count($prices));
            $segment->setAveragePopularityRate(array_sum($popularities) / count($popularities));
            $segment->setAverageSatisfactionRate(array_sum($satisfactions) / count($satisfactions));
            $this->em->persist($segment);
        }
        // persist data
        $this->em->flush();
        return ["total" => $totalSegments + $totalRests, "totalRestaurants" => $totalRests, "totalSegments" => $totalSegments];
    }


}
