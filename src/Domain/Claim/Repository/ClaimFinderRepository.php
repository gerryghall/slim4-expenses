<?php

namespace App\Domain\Claim\Repository;

use App\Domain\Claim\Data\ClaimItem;
use App\Domain\Claim\Data\ClaimResult;
use App\Factory\QueryFactory;

/**
 * Repository.
 */
final class ClaimFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findAllClaims(): ClaimResult
    {
        $query = $this->standardQuery();

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ClaimResult();
    }

    public function findClaims(array $params): ClaimResult
    {
        $query = $this->standardQuery();
        $where = $this->createWhere($params);
        $query->where($where);

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ClaimResult();
    }

    public function existsClaimId(int $Id): bool
    {
        $query = $this->queryFactory->newSelect(['c' => 'claim']);
        $query->select(['c.id']);

        return (bool)$query->execute()->fetchColumn(1);
    }

    public function findClaimsByParticipant(): ClaimResult
    {
        $query = $this->standardQuery();
        $query->where([
            'p.id' => 1,
        ]);

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ClaimResult();
    }

    protected function createWhere($params): array
    {
        $where = [];
        if (isset($params['id'])) {
            $where['c.id'] = $params['id'];
        }
        if (isset($params['participant_id'])) {
            $where['p.id'] = $params['participant_id'];
        }
        if (isset($params['claim_date'])) {
            $where['c.claim_date'] = $params['claim_date'];
        }
        if (isset($params['visit_date'])) {
            $where['c.visit_date'] = $params['visit_date'];
        }
        if (isset($params['site_number'])) {
            $where['c.site_number'] = $params['site_number'];
        }
        if (isset($params['study_reference'])) {
            $where['c.study_reference'] = $params['study_reference'];
        }

        return $where;
    }

    protected function standardQuery(): \Cake\Database\Query
    {
        $query = $this->queryFactory->newSelect(['c' => 'claim']);

        $query->select(
            [
                'c.id',
                'c.claim_date',
                'c.visit_date',
                'c.site_number',
                'c.study_reference',
                'p.firstname',
                'p.lastname',
                'participant_id' => 'p.id',
            ]
        );
        $query->join([
            'p' => [
                'table' => 'participant',
                'type' => 'INNER',
                'conditions' => 'p.id = c.participant_id',
            ],
        ]);

        return $query;
    }

    /**
     * @param array $items
     *
     * @return ClaimResult
     */
    private function transform(array $items): ClaimResult
    {
        $claimResult = new ClaimResult();
        // Turn that object into a structured array
        foreach ($items as $item) {
            $claimResult->claims[] = new ClaimItem($item);
        }

        return $claimResult;
    }
}
