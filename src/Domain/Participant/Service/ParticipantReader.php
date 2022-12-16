<?php

namespace App\Domain\Participant\Service;

use App\Domain\Participant\Data\ParticipantData;
use App\Domain\Participant\Repository\ParticipantRepository;

/**
 * Service.
 */
final class ParticipantReader
{
    private ParticipantRepository $repository;

    /**
     * The constructor.
     *
     * @param ParticipantRepository $repository The repository
     */
    public function __construct(ParticipantRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a participant.
     *
     * @param int $participantId The participant id
     *
     * @return ParticipantData The participant data
     */
    public function getParticipantData(int $participantId): ParticipantData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $participant = $this->repository->getParticipantById($participantId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $participant;
    }
}
