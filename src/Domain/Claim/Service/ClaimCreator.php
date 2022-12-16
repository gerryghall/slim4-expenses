<?php

namespace App\Domain\Claim\Service;

use App\Domain\Claim\Repository\ClaimRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class ClaimCreator
{
    private ClaimRepository $repository;

    private ClaimValidator $claimValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param ClaimRepository $repository The repository
     * @param ClaimValidator $claimValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        ClaimRepository $repository,
        ClaimValidator $claimValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->claimValidator = $claimValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('claim_creator.log')
            ->createLogger();
    }

    /**
     * Create a new claim.
     *
     * @param array $data The form data
     *
     * @return string The new claim claimname/key
     */
    public function createClaim(array $data): int
    {
        // Input validation
        $this->claimValidator->validateClaim($data);

        // Insert claim and get new claim ID
        $claimId = $this->repository->createClaim($data);

        // Logging
        $this->logger->info(sprintf('Claim created successfully: %s', $claimId));

        return $claimId;
    }
}
