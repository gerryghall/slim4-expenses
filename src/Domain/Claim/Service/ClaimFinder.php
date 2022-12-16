<?php

namespace App\Domain\Claim\Service;

use App\Domain\Claim\Data\ClaimItem;
use App\Domain\Claim\Data\ClaimResult;
use App\Domain\Claim\Repository\ClaimFinderRepository;

/**
 * Service.
 */
final class ClaimFinder
{
    private ClaimFinderRepository $repository;

    /**
     * The constructor.
     *
     * @param ClaimFinderRepository $repository The repository
     */
    public function __construct(ClaimFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find claims.
     *
     * @return ClaimItem[] A list of claims
     */
    public function findAllClaims(): ClaimResult
    {
        // Input validation
        // ...

        return $this->repository->findAllClaims();
    }
}
