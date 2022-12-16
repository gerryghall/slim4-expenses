<?php

namespace App\Action\Claim;

use App\Domain\Claim\Service\ClaimReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Claim.
 */
final class ClaimReadAction
{
    private ClaimReader $claimReader;

    private JsonRenderer $jsonRenderer;

    /**
     * The constructor.
     *
     * @param ClaimReader $claimViewer The service
     * @param JsonRenderer $jsonRenderer The responder
     */
    public function __construct(ClaimReader $claimViewer, JsonRenderer $jsonRenderer)
    {
        $this->claimReader = $claimViewer;
        $this->jsonRenderer = $jsonRenderer;
    }

    /**
     * Claim.
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
        $claimId = (int)$args['claim_id'];

        // Invoke the domain (service class)
        $claim = $this->claimReader->getClaimData($claimId);

        // Transform result
        return $this->jsonRenderer->json($response, $claim);
    }
}
