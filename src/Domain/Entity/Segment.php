<?php

namespace Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Segment
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
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $deletedAt;

    /**
     * @var float
     */
    private $averagePopularityRate;

    /**
     * @var float
     */
    private $averageSatisfactionRate;

    /**
     * @var float
     */
    private $averagePrice;

    /**
     * @var int
     */
    private $totalReviews;

    /**
     * @var Restaurant[]
     */
    private $restaurants;

    /**
     *
     */
    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
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
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     * @return $this
     */
    public function setDeletedAt(?DateTime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAveragePopularityRate(): ?float
    {
        return $this->averagePopularityRate;
    }

    /**
     * @param float|null $averagePopularityRate
     * @return $this
     */
    public function setAveragePopularityRate(?float $averagePopularityRate): self
    {
        $this->averagePopularityRate = $averagePopularityRate;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAverageSatisfactionRate(): ?float
    {
        return $this->averageSatisfactionRate;
    }

    /**
     * @param float|null $averageSatisfactionRate
     * @return $this
     */
    public function setAverageSatisfactionRate(?float $averageSatisfactionRate): self
    {
        $this->averageSatisfactionRate = $averageSatisfactionRate;

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
     * @return Collection|Restaurant[]
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    /**
     * @param Restaurant $restaurant
     * @return $this
     */
    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants[] = $restaurant;
        }

        return $this;
    }

    /**
     * @param Restaurant $restaurant
     * @return $this
     */
    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->contains($restaurant)) {
            $this->restaurants->removeElement($restaurant);
        }

        return $this;
    }
}
