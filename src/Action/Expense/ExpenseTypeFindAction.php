<?php

namespace App\Action\Expense;

use App\Domain\Expense\Service\ExpenseTypeFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Expense.
 */
final class ExpenseTypeFindAction
{
    private ExpenseTypeFinder $expenseTypeFinder;

    private JsonRenderer $jsonRenderer;

    /**
     * The constructor.
     *
     * @param ExpenseTypeFinder $expenseTypeFinder
     * @param JsonRenderer $jsonRenderer The renderer
     */
    public function __construct(ExpenseTypeFinder $expenseTypeFinder, JsonRenderer $jsonRenderer)
    {
        $this->expenseTypeFinder = $expenseTypeFinder;
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
        $expenseTypes = $this->expenseTypeFinder->findExpenseTypes();

        return $this->jsonRenderer->json(
            $response,
            $expenseTypes
        );
    }
}
