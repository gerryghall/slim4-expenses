<?php

namespace App\Domain\Expense\Repository;

use App\Domain\Expense\Data\ExpenseDataItem;
use App\Domain\Expense\Data\ExpenseResult;
use App\Factory\QueryFactory;

/**
 * Repository.
 */
final class ExpenseFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findAllExpenses(): ExpenseResult
    {
        $query = $this->standardQuery();

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ExpenseResult();
    }

    public function findExpenses(array $params): ExpenseResult
    {
        $query = $this->standardQuery();
        $where = $this->createWhere($params);
        $query->where($where);

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ExpenseResult();
    }

    public function existsExpenseId(int $Id): bool
    {
        $query = $this->queryFactory->newSelect(['c' => 'claim']);
        $query->select(['c.id']);

        return (bool)$query->execute()->fetchColumn(1);
    }

    public function findExpensesByParticipant(): ExpenseResult
    {
        $query = $this->standardQuery();
        $query->where([
            'p.id' => 1,
        ]);

        return $this->transform($query->execute()->fetchAll('assoc')) ?: new ExpenseResult();
    }

    private function createWhere($params): array
    {
        $where = [];
        if (isset($params['id'])) {
            $where['c.id'] = $params['id'];
        }
        if (isset($params['participant_id'])) {
            $where['p.id'] = $params['participant_id'];
        }
        if (isset($params['claim_id'])) {
            $where['c.claim_id'] = $params['claim_id'];
        }

        return $where;
    }

    private function standardQuery(): \Cake\Database\Query
    {
        $query = $this->queryFactory->newSelect(['e' => 'expense']);

        $query->select(
            [
                'e.id',
                'e.amount',
                'et.name AS type',
                'eu.name AS unit_type',
                'c.study_reference',
                'p.id AS participant_id',
                'ai.text AS additional_information',
            ]
        );

        $query->join([
            'c' => [
                'table' => 'claim',
                'type' => 'INNER',
                'conditions' => 'c.id = e.claim_id',
            ],
        ]);

        $query->join([
            'et' => [
                'table' => 'expense_type',
                'type' => 'INNER',
                'conditions' => 'et.id = e.type',
            ],
        ]);

        $query->join([
            'eu' => [
                'table' => 'expense_unit',
                'type' => 'INNER',
                'conditions' => 'eu.id = e.unit_type',
            ],
        ]);

        $query->join([
            'p' => [
                'table' => 'participant',
                'type' => 'INNER',
                'conditions' => 'p.id = c.participant_id',
            ],
        ]);

        $query->join([
            'ai' => [
                'table' => 'additional_information',
                'type' => 'INNER',
                'conditions' => 'ai.expense_id = e.id',
            ],
        ]);

        return $query;
    }

    private function transform(array $expenses): ExpenseResult
    {
        $expenseResult = new ExpenseResult();
        // Turn that object into a structured array
        foreach ($expenses as $expense) {
            $expenseResult->expenses[] = new ExpenseDataItem($expense);
        }

        return $expenseResult;
    }
}
