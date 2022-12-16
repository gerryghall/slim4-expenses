<?php

namespace App\Domain\Participant\Service;

use App\Domain\Participant\Data\ParticipantItem;
use App\Domain\Participant\Data\ParticipantResult;
use App\Domain\Participant\Repository\ParticipantFinderRepository;

/**
 * Service.
 */
final class ParticipantFinder
{
    private ParticipantFinderRepository $repository;

    /**
     * The constructor.
     *
     * @param ParticipantFinderRepository $repository The repository
     */
    public function __construct(ParticipantFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find participants.
     *
     * @return ParticipantItem[] A list of participants
     */
    public function findParticipants(): ParticipantResult
    {
        // Input validation
        // ...

        return $this->repository->findAllParticipants();
    }
}
