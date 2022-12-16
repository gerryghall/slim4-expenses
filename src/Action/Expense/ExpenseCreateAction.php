<?php

namespace App\Action\Expense;

use App\Domain\Expense\Service\ExpenseCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Expense.
 */
final class ExpenseCreateAction
{
    private JsonRenderer $jsonRenderer;

    private ExpenseCreator $expenseCreator;

    /**
     * The constructor.
     *
     * @param JsonRenderer $renderer The responder
     * @param ExpenseCreator $expenseCreator The service
     */
    public function __construct(JsonRenderer $renderer, ExpenseCreator $expenseCreator)
    {
        $this->jsonRenderer = $renderer;
        $this->expenseCreator = $expenseCreator;
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
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $expenseId = $this->expenseCreator->creatExpense($data);

        // Build the HTTP response
        return $this->jsonRenderer
            ->json($response, ['expense_id' => $expenseId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
