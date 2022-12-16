<?php

namespace App\Domain\Participant\Repository;

use App\Domain\Participant\Data\ParticipantItem;
use App\Domain\Participant\Data\ParticipantResult;
use App\Factory\QueryFactory;

/**
 * Repository.
 */
final class ParticipantFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findAllParticipants(): ParticipantResult
    {
        $query = $this->standardQuery();

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ParticipantResult();
    }

    public function findParticipants(array $params): ParticipantResult
    {
        $query = $this->standardQuery();
        $where = $this->createWhere($params);
        $query->where($where);

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ParticipantResult();
    }

    public function findParticipantById(): ParticipantResult
    {
        $query = $this->standardQuery();
        $query->where([
            'p.id' => 1,
        ]);

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ParticipantResult();
    }

    protected function createWhere($params): array
    {
        $where = [];
        if (isset($params['id'])) {
            $where['p.id'] = $params['id'];
        }
        if (isset($params['eamil'])) {
            $where['p.eamil'] = $params['email'];
        }

        return $where;
    }

    protected function standardQuery(): \Cake\Database\Query
    {
        $query = $this->queryFactory->newSelect(['p' => 'participant']);

        $query->select(
            [
                'p.id',
                'p.firstname',
                'p.lastname',
                'p.email'
            ]
        );
        return $query;
    }

    /**
     * @param array $items
     *
     * @return ParticipantResult
     */
    private function transform(array $items): ParticipantResult
    {
        $result = new ParticipantResult();
        // Turn that object into a structured array
        foreach ($items as $item) {
            $result->participants[] = new ParticipantItem($item);
        }

        return $result;
    }
}
