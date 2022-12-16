<?php

namespace App\Domain\Claim\Service;

use App\Domain\Claim\Data\ClaimItem;
use App\Domain\Claim\Repository\ClaimFinderRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class ClaimUpdater
{
    private ClaimFinderRepository $repository;

    private ClaimValidator $claimValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param ClaimFinderRepository $repository The repository
     * @param ClaimValidator $claimValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        ClaimFinderRepository $repository,
        ClaimValidator $claimValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->claimValidator = $claimValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('claim_updater.log')
            ->createLogger();
    }

    /**
     * Update claim.
     *
     * @param int $claimId The claim id
     * @param array $data The request data
     *
     * @return void
     */
    public function updateClaim(int $claimId, array $data): void
    {
        // Input validation
        $this->claimValidator->validateClaimUpdate($claimId, $data);

        // Validation was successfully
        $claim = new ClaimItem($data);
        $claim->id = $claimId;

        // Update the claim
        $this->repository->updateClaim($claim);

        // Logging
        $this->logger->info(sprintf('Claim updated successfully: %s', $claimId));
    }
}
