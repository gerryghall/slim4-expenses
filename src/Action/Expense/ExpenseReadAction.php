<?php

namespace App\Action\Expense;

use App\Domain\Expense\Service\ExpenseReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Expense.
 */
final class ExpenseReadAction
{
    private ExpenseReader $expenseReader;

    private JsonRenderer $jsonRenderer;

    /**
     * The constructor.
     *
     * @param ExpenseReader $expenseViewer The service
     * @param JsonRenderer $jsonRenderer The responder
     */
    public function __construct(ExpenseReader $expenseViewer, JsonRenderer $jsonRenderer)
    {
        $this->expenseReader = $expenseViewer;
        $this->jsonRenderer = $jsonRenderer;
    }

    /**
     * Expense.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The routing arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $expenseId = (int)$args['expense_id'];

        // Invoke the domain (service class)
        $expense = $this->expenseReader->getExpenseById($expenseId);

        // Transform result
        return $this->jsonRenderer->json(
            $response,
            $expense
        );
    }
}
