<?php

namespace App\Domain\Expense\Service;

use App\Domain\Expense\Data\ExpenseTypeResult;
use App\Domain\Expense\Repository\ExpenseRepository;

/**
 * Service.
 */
final class ExpenseTypeFinder
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

    public function findExpenseTypes(): ExpenseTypeResult
    {
        return $this->repository->findExpenseTypes();
    }
}
