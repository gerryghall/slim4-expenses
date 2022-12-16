<?php

namespace App\Domain\Participant\Service;

use App\Domain\Participant\Data\ParticipantItem;
use App\Domain\Participant\Service\ParticipantVaidator;
use App\Domain\Participant\Repository\ParticipantRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class ParticipantUpatder
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
            ->addFileHandler('participant_updater.log')
            ->createLogger();
    }

    /**
     * Update participant.
     *
     * @param int $participantId The participant id
     * @param array $data The request data
     *
     * @return void
     */
    public function updateParticipant(int $participantId, array $data): void
    {
        // Input validation
        $this->participantValidator->validateParticipantUpdate($participantId, $data);

        // Validation was successfully
        $participant = new ParticipantData($data);
        $participant->id = $participantId;

        // Update the participant
        $this->repository->updateParticipant($participant);

        // Logging
        $this->logger->info(sprintf('Participant updated successfully: %s', $participantId));
    }
}
