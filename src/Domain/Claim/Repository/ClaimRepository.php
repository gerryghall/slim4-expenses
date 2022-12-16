<?php

namespace App\Domain\Claim\Repository;

use App\Domain\Claim\Data\ClaimItem;
use App\Factory\QueryFactory;

/**
 * Repository.
 */
final class ClaimRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function updateClaim(int $claimId, array $data): void
    {
        $claim = new ClaimItem($data);
        $this->queryFactory->newUpdate('claim', $claim->toRow())
            ->where(['id' => $claimId])
            ->execute();

        $query = $this->queryFactory->newUpdate('claim', $data);
        $query->execute();
    }

    public function createClaim(array $data): int
    {
        try {
            $claim = new ClaimItem($data);
            $resp = $this->queryFactory->newInsert('claim', $claim->toRow())
                ->execute()
                ->lastInsertId();
        } catch (\Exception $e) {
            $resp = 0;
        }

        return (int)$resp;
    }

    public function deleteClaim($claimId): int
    {
        try {
            $this->queryFactory->newDelete('claim')
                ->where(['id' => $claimId])
                ->execute();
            $resp = $claimId;
        } catch (\Exception $e) {
            $resp = 0;
        }

        return $resp;
    }
}
