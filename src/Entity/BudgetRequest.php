<?php

namespace App\Entity;

use App\Repository\BudgetRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BudgetRequestRepository::class)
 */
class BudgetRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="budgetRequests", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * BudgetRequest constructor.
     * @param $title
     * @param $description
     * @param $category
     * @param $User
     * @param $status
     */
    private function __construct($title,
                                 $description,
                                 $category,
                                 $User,
                                 $status)
    {
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->User = $User;
        $this->status = $status;
    }

    public static function create($title,
                                  $description,
                                  $category,
                                  $User,
                                  $status = 'pending')
    {
        return new BudgetRequest($title, $description, $category, $User, $status);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

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

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
