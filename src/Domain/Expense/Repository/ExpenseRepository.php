<?php

namespace App\Domain\Expense\Repository;

use App\Domain\Expense\Data\ExpenseDataItem;
use App\Domain\Expense\Data\ExpenseItem;
use App\Domain\Expense\Data\ExpenseTypeResult;
use App\Domain\Expense\Data\ExpenseUnitResult;
use App\Factory\QueryFactory;

/**
 * Repository.
 */
final class ExpenseRepository
{
    /**
     * @var QueryFactory
     */
    private QueryFactory $queryFactory;

    /**
     * @param QueryFactory $queryFactory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * @param $id
     *
     * @return ExpenseDataItem
     */
    public function getExpenseById($id): ExpenseDataItem
    {
        $query = $this->queryFactory->newSelect(['et' => 'expense']);

        $query->select(
            ['et.id']
        );
        $query->where(['et.id' => $id]);

        return new ExpenseDataItem($query->execute()->fetchAll('assoc'));
    }

    /**
     * @param int $claimId
     * @param ExpenseItem $data
     *
     * @return ExpenseItem
     */
    public function updateExpense(ExpenseItem $data): ExpenseItem
    {
        $row = $data->toRow();

        $this->queryFactory->newUpdate('expense', $row)
            ->where(['id' => $data->id])
            ->execute();

        return $data;
    }

    /**
     * @param ExpenseItem $data
     *
     * @return int
     */
    public function createExpense(ExpenseItem $data): int
    {
        try {
            $resp = $this->queryFactory->newInsert('expense', $data->toRow())
                ->execute()
                ->lastInsertId();
        } catch (\Exception $e) {
            $resp = 0;
        }

        return (int)$resp;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function deleteExpense($id): int
    {
        try {
            $this->queryFactory->newDelete('expense')
                ->where(['id' => $id])
                ->execute();
            $resp = $id;
        } catch (\Exception $e) {
            $resp = 0;
        }

        return $resp;
    }

    /**
     * @return ExpenseTypeResult
     */
    public function findExpenseTypes(): ExpenseTypeResult
    {
        $query = $this->queryFactory->newSelect(['et' => 'expense_type']);

        $query->select(
            ['et.id', 'et.name']
        );

        return $this->transformType($query->execute()->fetchAll('assoc')) ?: new ExpenseTypeResult();
    }

    /**
     * @return ExpenseUnitResult
     */
    public function findExpenseUnits(): ExpenseUnitResult
    {
        $query = $this->queryFactory->newSelect(['eu' => 'expense_unit']);

        $query->select(
            [
                'eu.id',
                'eu.name',
            ]
        );

        return $this->transformUnit($query->execute()->fetchAll('assoc')) ?: new ExpenseUnitResult();
    }

    /**
     * @param array $types
     *
     * @return ExpenseTypeResult
     */
    private function transformType(array $types): ExpenseTypeResult
    {
        $expenseResult = new ExpenseTypeResult();
        // Turn that object into a structured array
        foreach ($types as $type) {
            $expenseResult->types[] = new ExpenseDataItem($type);
        }

        return $expenseResult;
    }

    /**
     * @param array $types
     *
     * @return ExpenseUnitResult
     */
    private function transformUnit(array $types): ExpenseUnitResult
    {
        $expenseResult = new ExpenseUnitResult();
        // Turn that object into a structured array
        foreach ($types as $type) {
            $expenseResult->units[] = new ExpenseDataItem($type);
        }

        return $expenseResult;
    }
}
