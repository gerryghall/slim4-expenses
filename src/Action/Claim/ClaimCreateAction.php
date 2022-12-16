<?php

namespace App\Action\Claim;

use App\Domain\Claim\Service\ClaimCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Claim.
 */
final class ClaimCreateAction
{
    private JsonRenderer $jsonRenderer;

    private ClaimCreator $claimCreator;

    /**
     * The constructor.
     *
     * @param JsonRenderer $renderer The responder
     * @param ClaimCreator $claimCreator The service
     */
    public function __construct(JsonRenderer $renderer, ClaimCreator $claimCreator)
    {
        $this->jsonRenderer = $renderer;
        $this->claimCreator = $claimCreator;
    }

    /**
     * Claim.
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
        $claimId = $this->claimCreator->createClaim($data);

        // Build the HTTP response
        return $this->jsonRenderer
            ->json($response, ['claim_id' => $claimId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
