<?php

namespace App\Domain\Expense\Service;

use App\Domain\Expense\Repository\ExpenseRepository;

/**
 * Service.
 */
final class ExpenseReader
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
     * Read a expense.
     *
     * @param int $expenseId The expense id
     */
    public function getExpenseById(int $expenseId)
    {
        // Input validation
        // ...

        // Fetch data from the database
        $expense = $this->repository->getExpenseById($expenseId);

        return $expense;
    }
}
