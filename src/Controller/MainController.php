<?php

namespace App\Controller;

use App\Repository\BudgetRequestRepository;
use App\Repository\UserRepository;
use App\UseCases\CreateBudgetRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/budgetRequest/add", name="add_budget_request")
     * @param Request $req
     * @param UserRepository $userRepository
     * @param BudgetRequestRepository $budgetRequestRepository
     * @return JsonResponse
     */
    public function add(
        Request $req,
        UserRepository $userRepository,
        BudgetRequestRepository $budgetRequestRepository
    )
    {
        // TODO buscar inyección de dependencias en un controller

        (new CreateBudgetRequest(
            $budgetRequestRepository,
            $userRepository)
        )->execute(
            $req->get('title'),
            $req->get('description'),
            $req->get('category'),
            $req->get('email'),
            $req->get('phone'),
            $req->get('address')
        );

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
