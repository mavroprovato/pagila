<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Staff;
use App\Entity\Store;
use App\Repository\StaffRepository;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The staff controller
 */
#[Route('/api/staff')]
class StaffController extends AbstractController
{

    /**
     * List staff.
     *
     * @param StaffRepository $repository The store repository.
     * @return Response The response.
     */
    #[Route('/', name: 'staff_list')]
    public function list(StaffRepository $repository): Response
    {
        $results = $repository->createQueryBuilder('staff')
            ->select('staff', 'address', 'city', 'country', 'store')
            ->leftJoin('staff.address', 'address')
            ->leftJoin('address.city', 'city')
            ->leftJoin('city.country', 'country')
            ->leftJoin('staff.store', 'store')
            ->getQuery()->getResult();

        return $this->json($results);
    }

    /**
     * Return a staff.
     *
     * @param Staff $staff The staff.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'staff_read')]
    public function show(Staff $staff): Response
    {
        return $this->json($staff);
    }
}