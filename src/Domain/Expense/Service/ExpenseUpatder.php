<?php

namespace App\Domain\Expense\Service;

use App\Domain\Expense\Data;
use App\Domain\Expense\Repository\ExpenseRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class ExpenseUpatder
{
    private ExpenseRepository $repository;

    private ExpenseVaidator $expenseValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param ExpenseRepository $repository The repository
     * @param ExpenseVaidator $expenseValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        ExpenseRepository $repository,
        ExpenseVaidator $expenseValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->expenseValidator = $expenseValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('expense_updater.log')
            ->createLogger();
    }

    /**
     * Update expense.
     *
     * @param int $expenseId The expense id
     * @param array $data The request data
     *
     * @return void
     */
    public function updateExpense(int $expenseId, array $data): void
    {
        // Input validation
        $this->expenseValidator->validateExpenseUpdate($expenseId, $data);

        // Validation was successfully
        $expense = new Data\ExpenseItem($data);
        $expense->id = $expenseId;

        // Update the expense
        $this->repository->updateExpense($expense);

        // Logging
        $this->logger->info(sprintf('Expense updated successfully: %s', $expenseId));
    }
}
