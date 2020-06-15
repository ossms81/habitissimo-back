<?php

namespace App\UseCases;

use App\Repository\BudgetRequestRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\BudgetRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class CreateBudgetRequest
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var BudgetRequestRepository
     */
    private $budgetRequestRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CreateBudgetRequest constructor.
     * @param BudgetRequestRepository $budgetRequestRepository
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(
        BudgetRequestRepository $budgetRequestRepository,
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->budgetRequestRepository = $budgetRequestRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    /**
     * @param $title
     * @param $description
     * @param $category
     * @param $email
     * @param $phone
     * @param $address
     * @return void
     */
    public function execute(
        $title,
        $description,
        $category,
        $email,
        $phone,
        $address
    )
    {
        $this->saveBudgetRequest(
            $this->addBudgetRequest(
                $title,
                $description,
                $category,
                $this->userRepository->updateIfExists(
                    $this->addUser(
                        $email,
                        $phone,
                        $address
                    )
                )
            )
        );
    }

    /**
     * @param $email
     * @param $phone
     * @param $address
     * @return User
     */
    private function addUser(
        $email,
        $phone,
        $address
    ): User
    {
        return User::create(
            $email,
            $phone,
            $address
        );
    }

    /**
     * @param $title
     * @param $description
     * @param $category
     * @param User $user
     * @return BudgetRequest
     */
    private function addBudgetRequest(
        $title,
        $description,
        $category,
        User $user
    )
    {
        return BudgetRequest::create(
            $title,
            $description,
            $category,
            $user
        );
    }

    /**
     * @param BudgetRequest $budgetRequest
     */
    private function saveBudgetRequest(BudgetRequest $budgetRequest)
    {
        $this->budgetRequestRepository->save($budgetRequest);
    }
}