<?php

namespace App\DataFixtures;

use App\Entity\BudgetRequest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BudgetRequestFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $budgetRequest1 = BudgetRequest::create(
            'Presupuesto 1',
            'La obra de El Escorial',
            'Construcción Casas',
            $this->getReference(UserFixture::USER1_REFERENCE)
        );
        $manager->persist($budgetRequest1);

        $budgetRequest2 = BudgetRequest::create(
            'Presupuesto 2',
            'Quiero reformar el baño por completo',
            'Reformas Baños',
            $this->getReference(UserFixture::USER2_REFERENCE)
        );
        $manager->persist($budgetRequest2);

        $budgetRequest3 = BudgetRequest::create(
            'Presupuesto 3',
            'Instalación de aire acondicionado',
            'Aire acondicionado',
            $this->getReference(UserFixture::USER2_REFERENCE)
        );
        $manager->persist($budgetRequest3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
        ];
    }
}
