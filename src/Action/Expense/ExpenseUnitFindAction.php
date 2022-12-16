<?php

namespace App\Action\Expense;

use App\Domain\Expense\Service\ExpenseUnitFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Expense.
 */
final class ExpenseUnitFindAction
{
    private ExpenseUnitFinder $expenseUnitFinder;

    private JsonRenderer $jsonRenderer;

    /**
     * The constructor.
     *
     * @param ExpenseUnitFinder $expenseUnitFinder The expense index list viewer
     * @param JsonRenderer $jsonRenderer The renderer
     */
    public function __construct(ExpenseUnitFinder $expenseUnitFinder, JsonRenderer $jsonRenderer)
    {
        $this->expenseUnitFinder = $expenseUnitFinder;
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
        return $this->jsonRenderer->json(
            $response,
            $this->expenseUnitFinder->findExpenseUnits()
        );
    }
}
