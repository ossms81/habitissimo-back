<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=BudgetRequest::class, mappedBy="User")
     */
    private $budgetRequests;

    public function __construct()
    {
        $this->budgetRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    /**
     * @return Collection|BudgetRequest[]
     */
    public function getBudgetRequests(): Collection
    {
        return $this->budgetRequests;
    }

    public function addBudgetRequest(BudgetRequest $budgetRequest): self
    {
        if (!$this->budgetRequests->contains($budgetRequest)) {
            $this->budgetRequests[] = $budgetRequest;
            $budgetRequest->setUser($this);
        }

        return $this;
    }

    public function removeBudgetRequest(BudgetRequest $budgetRequest): self
    {
        if ($this->budgetRequests->contains($budgetRequest)) {
            $this->budgetRequests->removeElement($budgetRequest);
            // set the owning side to null (unless already changed)
            if ($budgetRequest->getUser() === $this) {
                $budgetRequest->setUser(null);
            }
        }

        return $this;
    }
}
