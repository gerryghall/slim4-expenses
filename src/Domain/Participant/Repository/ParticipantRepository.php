<?php

namespace App\Domain\Participant\Repository;
use App\Domain\Participant\Data\ParticipantItem;
use App\Factory\QueryFactory;
/**
 * Repository.
 */
final class ParticipantRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function existsParticipantId(int $Id): bool
    {
        $query = $this->queryFactory->newSelect(['p' => 'participant']);
        $query->select(['p.id'])
            ->where(['id' => $Id]);

        return (bool)$query->execute()->fetch('assoc');
    }
    public function updateParticipant(int $participantId, array $data): void
    {
        $participant = new ParticipantItem($data);
        $this->queryFactory->newUpdate('claim', $participant->toRow())
            ->where(['id' => $participantId])
            ->execute();

        $query = $this->queryFactory->newUpdate('participant', $data);
        $query->execute();
    }

    public function createParticipant(array $data): int
    {
        try {
            $participant = new ParticipantItem($data);
            $resp = $this->queryFactory->newInsert('participant', $participant->toRow())
                ->execute()
                ->lastInsertId();
        } catch (\Exception $e) {
            $resp = 0;
        }

        return (int)$resp;
    }

    public function deleteParticipant($participantId): int
    {
        try {
            $this->queryFactory->newDelete('claim')
                ->where(['id' => $participantId])
                ->execute();
            $resp = $participantId;
        } catch (\Exception $e) {
            $resp = 0;
        }

        return $resp;
    }
}
