<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $locationDate = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $returnDate = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    private ?float $totalAmount = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?float $transportPrice = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?float $guardPrice = null;

    #[ORM\Column(type: 'string', columnDefinition: 'ENUM(\'Ongoing\', \'Completed\', \'Cancelled\')')]
    #[Assert\NotBlank]
    private ?string $status = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private ?string $address = null;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $createdAt = null;

    // Getters and setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function getLocationDate(): ?\DateTimeInterface
    {
        return $this->locationDate;
    }

    public function setLocationDate(\DateTimeInterface $locationDate): self
    {
        $this->locationDate = $locationDate;
        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(?\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;
        return $this;
    }

    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    public function getTransportPrice(): ?float
    {
        return $this->transportPrice;
    }

    public function setTransportPrice(?float $transportPrice): self
    {
        $this->transportPrice = $transportPrice;
        return $this;
    }

    public function getGuardPrice(): ?float
    {
        return $this->guardPrice;
    }

    public function setGuardPrice(?float $guardPrice): self
    {
        $this->guardPrice = $guardPrice;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
