<?php

namespace Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Restaurant
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $uidentifier;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var string
     */
    private $cityName;

    /**
     * @var float
     */
    private $popularityRate;

    /**
     * @var float
     */
    private $satisfactionRate;

    /**
     * @var float
     */
    private $averagePrice;

    /**
     * @var int
     */
    private $totalReviews;

    /**
     * @var Segment[]
     */
    private $segments;

    /**
     *
     */
    public function __construct()
    {
        $this->segments = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUidentifier(): ?string
    {
        return $this->uidentifier;
    }

    /**
     * @param string $uidentifier
     * @return $this
     */
    public function setUidentifier(string $uidentifier): self
    {
        $this->uidentifier = $uidentifier;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return $this
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     * @return $this
     */
    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     * @return $this
     */
    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    /**
     * @param string $cityName
     * @return Restaurant
     */
    public function setCityName(string $cityName): self
    {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPopularityRate(): ?float
    {
        return $this->popularityRate;
    }

    /**
     * @param float|null $popularityRate
     * @return $this
     */
    public function setPopularityRate(?float $popularityRate): self
    {
        $this->popularityRate = $popularityRate;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getSatisfactionRate(): ?float
    {
        return $this->satisfactionRate;
    }

    /**
     * @param float|null $satisfactionRate
     * @return $this
     */
    public function setSatisfactionRate(?float $satisfactionRate): self
    {
        $this->satisfactionRate = $satisfactionRate;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAveragePrice(): ?float
    {
        return $this->averagePrice;
    }

    /**
     * @param float|null $averagePrice
     * @return $this
     */
    public function setAveragePrice(?float $averagePrice): self
    {
        $this->averagePrice = $averagePrice;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTotalReviews(): ?int
    {
        return $this->totalReviews;
    }

    /**
     * @param int|null $totalReviews
     * @return $this
     */
    public function setTotalReviews(?int $totalReviews): self
    {
        $this->totalReviews = $totalReviews;

        return $this;
    }

    /**
     * @return Collection|Segment[]
     */
    public function getSegments(): Collection
    {
        return $this->segments;
    }

    /**
     * @param Segment $segment
     * @return $this
     */
    public function addSegment(Segment $segment): self
    {
        if (!$this->segments->contains($segment)) {
            $this->segments[] = $segment;
            $segment->addRestaurant($this);
        }

        return $this;
    }

    /**
     * @param Segment $segment
     * @return $this
     */
    public function removeSegment(Segment $segment): self
    {
        if ($this->segments->contains($segment)) {
            $this->segments->removeElement($segment);
            $segment->removeRestaurant($this);
        }

        return $this;
    }
}
