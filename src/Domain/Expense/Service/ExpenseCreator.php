<?php

namespace App\Domain\Expense\Service;

use App\Domain\Expense\Data\ExpenseItem;
use App\Domain\Expense\Repository\ExpenseRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class ExpenseCreator
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
            ->addFileHandler('expense_creator.log')
            ->createLogger();
    }

    /**
     * Create a new expense.
     *
     * @param array $data The form data
     *
     * @return string The new expense expensename/key
     */
    public function createExpense(array $data): string
    {
        // Input validation
        $this->expenseValidator->validateExpense($data);

        // Insert expense and get new expense ID
        $expenseId = $this->repository->createExpense(new ExpenseItem($data));

        // Logging
        $this->logger->info(sprintf('Expense created successfully: %s', $expenseId));

        return $expenseId;
    }
}
