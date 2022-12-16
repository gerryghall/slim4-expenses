<?php

namespace App\Action\Participant;

use App\Domain\Participant\Service\ParticipantFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Participant.
 */
final class ParticipantFindAction
{
    private ParticipantFinder $participantFinder;

    private JsonRenderer $jsonRenderer;

    /**
     * The constructor.
     *
     * @param ParticipantFinder $participantIndex The participant index list viewer
     * @param JsonRenderer $jsonRenderer The renderer
     */
    public function __construct(ParticipantFinder $participantIndex, JsonRenderer $jsonRenderer)
    {
        $this->participantFinder = $participantIndex;
        $this->jsonRenderer = $jsonRenderer;
    }

    /**
     * Participant.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the findParticipants method
        $participants = $this->participantFinder->findParticipants();
        return $this->jsonRenderer->json(
        $response,$participants
    );
    }

}
