<?php

namespace App\Tests\UseCases;

use App\UseCases\CreateBudgetRequest;
use PHPUnit\Framework\TestCase;

class CreateBudgetRequestTest extends TestCase
{
    /**
     * @test
     */
    public function shouldUpdateUserIfExists(): void
    {
        $this->userRepository->updateIfExists(
            $this->addUser(
                $email,
                $phone,
                $address
            )
        );
    }
}
