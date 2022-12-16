<?php

namespace App\Action\Claim;

use App\Domain\Claim\Service\ClaimDeleter;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Claim.
 */
final class ClaimDeleteAction
{
    private ClaimDeleter $claimDeleter;

    private JsonRenderer $renderer;

    /**
     * The constructor.
     *
     * @param ClaimDeleter $claimDeleter The service
     * @param JsonRenderer $renderer The responder
     */
    public function __construct(ClaimDeleter $claimDeleter, JsonRenderer $renderer)
    {
        $this->claimDeleter = $claimDeleter;
        $this->renderer = $renderer;
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
        $this->claimDeleter->deleteClaim($claimId);

        // Render the json response
        return $this->renderer->json($response);
    }
}
