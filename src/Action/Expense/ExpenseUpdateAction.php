<?php

namespace App\Action\Expense;

use App\Domain\Expense\Service\ExpenseUpatder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Expense.
 */
final class ExpenseUpdateAction
{
    private JsonRenderer $jsonRenderer;

    private ExpenseUpatder $expenseUpdater;

    /**
     * The constructor.
     *
     * @param JsonRenderer $jsonRenderer The renderer
     * @param ExpenseUpatder $expenseUpdater The service
     */
    public function __construct(JsonRenderer $jsonRenderer, ExpenseUpatder $expenseUpdater)
    {
        $this->jsonRenderer = $jsonRenderer;
        $this->expenseUpdater = $expenseUpdater;
    }

    /**
     * Expense.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $expenseId = (int)$args['expense_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->expenseUpdater->updateExpense($expenseId, $data);

        // Build the HTTP response
        return $this->jsonRenderer->json($response);
    }
}
