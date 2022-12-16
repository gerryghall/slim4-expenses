<?php

namespace App\Domain\Expense\Service;

use App\Domain\Expense\Data\ExpenseUnitResult;
use App\Domain\Expense\Repository\ExpenseRepository;

/**
 * Service.
 */
final class ExpenseUnitFinder
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

    public function findExpenseUnits(): ExpenseUnitResult
    {
        return $this->repository->findExpenseUnits();
    }
}
