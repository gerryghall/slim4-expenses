<?php

namespace App\Domain\Expense\Service;

use App\Domain\Expense\Repository\ExpenseRepository;

/**
 * Service.
 */
final class ExpenseDeleter
{
    private ExpenseRepository $repository;

    /**
     * The constructor.
     *
     * @param ExpenseRepository $repository The repository
     */
    public function __construct(ExpenseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete expense.
     *
     * @param int $expenseId The expense id
     *
     * @return void
     */
    public function deleteExpense(int $expenseId): void
    {
        // Input validation
        // ...

        $this->repository->deleteExpenseById($expenseId);
    }
}
