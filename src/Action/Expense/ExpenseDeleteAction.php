<?php

namespace App\Action\Expense;

use App\Domain\Expense\Service\ExpenseDeleter;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Expense.
 */
final class ExpenseDeleteAction
{
    private ExpenseDeleter $expenseDeleter;

    private JsonRenderer $renderer;

    /**
     * The constructor.
     *
     * @param ExpenseDeleter $expenseDeleter The service
     * @param JsonRenderer $renderer The responder
     */
    public function __construct(ExpenseDeleter $expenseDeleter, JsonRenderer $renderer)
    {
        $this->expenseDeleter = $expenseDeleter;
        $this->renderer = $renderer;
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
        $this->expenseDeleter->deleteExpense($expenseId);

        // Render the json response
        return $this->renderer->json($response);
    }
}
