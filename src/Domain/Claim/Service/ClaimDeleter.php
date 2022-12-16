<?php

namespace App\Domain\Claim\Service;

use App\Domain\Claim\Repository\ClaimFinderRepository;

/**
 * Service.
 */
final class ClaimDeleter
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
     * Delete claim.
     *
     * @param int $claimId The claim id
     *
     * @return void
     */
    public function deleteClaim(int $claimId): void
    {
        // Input validation
        // ...

        $this->repository->deleteClaimById($claimId);
    }
}
