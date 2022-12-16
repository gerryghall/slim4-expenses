<?php

namespace App\Domain\Participant\Service;

use App\Domain\Participant\Repository\ParticipantRepository;
use App\Domain\Participant\Service\ParticipantVaidator;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class ParticipantCreator
{
    private ParticipantRepository $repository;

    private ParticipantVaidator $participantValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param ParticipantRepository $repository The repository
     * @param ParticipantVaidator $participantValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        ParticipantRepository $repository,
        ParticipantVaidator $participantValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->participantValidator = $participantValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('participant_creator.log')
            ->createLogger();
    }

    /**
     * Create a new participant.
     *
     * @param array $data The form data
     *
     * @return string The new participant participantname/key
     */
    public function createParticipant(array $data): string
    {
        // Input validation
        $this->participantValidator->validateParticipant($data);

        // Insert participant and get new participant ID
        $participantId = $this->repository->createParticipant($data);

        // Logging
        $this->logger->info(sprintf('Participant created successfully: %s', $participantId));

        return $participantId;
    }
}
