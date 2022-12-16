<?php

namespace App\Domain\Expense\Service;

use App\Domain\Expense\Data\ExpenseDataItem;
use App\Domain\Expense\Data\ExpenseResult;
use App\Domain\Expense\Repository\ExpenseFinderRepository;

/**
 * Service.
 */
final class ExpenseFinder
{
    private ExpenseFinderRepository $repository;

    /**
     * The constructor.
     *
     * @param ExpenseFinderRepository $repository The repository
     */
    public function __construct(ExpenseFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find expenses.
     *
     * @return ExpenseDataItem[] A list of expenses
     */
    public function findExpenses(): ExpenseResult
    {
        return $this->repository->findAllExpenses();
    }
}
