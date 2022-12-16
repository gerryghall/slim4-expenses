<?php

namespace App\Domain\Participant\Service;

use App\Domain\Participant\Repository\ParticipantRepository;

/**
 * Service.
 */
final class ParticipantDeleter
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
     * Delete participant.
     *
     * @param int $participantId The participant id
     *
     * @return void
     */
    public function deleteParticipant(int $participantId): void
    {
        // Input validation
        // ...

        $this->repository->deleteParticipantById($participantId);
    }
}
