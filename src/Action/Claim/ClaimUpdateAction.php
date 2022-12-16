<?php

namespace App\Action\Claim;

use App\Domain\Claim\Service\ClaimUpdater;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Claim.
 */
final class ClaimUpdateAction
{
    private JsonRenderer $jsonRenderer;

    private ClaimUpdater $claimUpdater;

    /**
     * The constructor.
     *
     * @param JsonRenderer $jsonRenderer The renderer
     * @param ClaimUpdater $claimUpdater The service
     */
    public function __construct(JsonRenderer $jsonRenderer, ClaimUpdater $claimUpdater)
    {
        $this->jsonRenderer = $jsonRenderer;
        $this->claimUpdater = $claimUpdater;
    }

    /**
     * Claim.
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
        $claimId = (int)$args['claim_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->claimUpdater->updateClaim($claimId, $data);

        // Build the HTTP response
        return $this->jsonRenderer->json($response);
    }
}
