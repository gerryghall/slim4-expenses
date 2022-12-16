<?php

namespace App\Action\Expense;

use App\Domain\Expense\Service\ExpenseFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Expense.
 */
final class ExpenseFindAction
{
    private ExpenseFinder $expenseFinder;

    private JsonRenderer $jsonRenderer;

    /**
     * The constructor.
     *
     * @param ExpenseFinder $expenseIndex The expense index list viewer
     * @param JsonRenderer $jsonRenderer The renderer
     */
    public function __construct(ExpenseFinder $expenseIndex, JsonRenderer $jsonRenderer)
    {
        $this->expenseFinder = $expenseIndex;
        $this->jsonRenderer = $jsonRenderer;
    }

    /**
     * Expense.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the findExpenses method
        $expenses = $this->expenseFinder->findExpenses();

        return $this->jsonRenderer->json(
            $response,
            $expenses
        );
    }
}
