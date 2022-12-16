<?php

namespace App\Action\Claim;

use App\Domain\Claim\Service\ClaimFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Claim.
 */
final class ClaimFindAction
{
    private ClaimFinder $claimFinder;

    private JsonRenderer $jsonRenderer;

    /**
     * The constructor.
     *
     * @param ClaimFinder $claimIndex The claim index list viewer
     * @param JsonRenderer $jsonRenderer The renderer
     */
    public function __construct(ClaimFinder $claimIndex, JsonRenderer $jsonRenderer)
    {
        $this->claimFinder = $claimIndex;
        $this->jsonRenderer = $jsonRenderer;
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
        // Optional: Pass parameters from the request to the findClaims method
        $claims = $this->claimFinder->findAllClaims();

        return $this->jsonRenderer->json(
            $response,
            $claims
        );
    }
}
