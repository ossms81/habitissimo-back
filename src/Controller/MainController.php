<?php

namespace App\Controller;

use App\Entity\BudgetRequest;
use App\Entity\User;
use App\Repository\BudgetRequestRepository;
use App\Repository\UserRepository;
use App\UseCases\CreateBudgetRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @var BudgetRequestRepository
     */
    private $budgetRequestRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * MainController constructor.
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
     * @Route("/budgetRequest/add", name="add_budget_request")
     * @param Request $req
     * @return JsonResponse
     */
    public function add(Request $req)
    {
        // TODO buscar inyección de dependencias en un controller

        (new CreateBudgetRequest(
            $this->budgetRequestRepository,
            $this->userRepository,
            $this->em)
        )->execute(
            $req->get('title'),
            $req->get('description'),
            $req->get('category'),
            $req->get('email'),
            $req->get('phone'),
            $req->get('address')
        );

//        $this->em->persist($budgetRequest);
//        $this->em->flush();


        return $this->json([
            'message' => 'Budget request created'
            /*'id' => $budgetRequest->getId(),
            'title' => $budgetRequest->getTitle(),
            'description' => $budgetRequest->getDescription(),
            'category' => $budgetRequest->getCategory(),
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'address' => $user->getAddress(),
            ],*/
        ]);
    }}
