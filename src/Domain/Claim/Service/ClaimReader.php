<?php

namespace App\Domain\Claim\Service;

use App\Domain\Claim\Data\ClaimData;
use App\Domain\Claim\Repository\ClaimFinderRepository;

/**
 * Service.
 */
final class ClaimReader
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
     * Read a claim.
     *
     * @param int $claimId The claim id
     *
     * @return ClaimData The claim data
     */
    public function getClaimData(int $claimId): ClaimData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $claim = $this->repository->getClaimById($claimId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $claim;
    }
}
