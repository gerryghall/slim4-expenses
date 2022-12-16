<?php

namespace App\Action\Participant;

use App\Domain\Participant\Service\ParticipantUpdater;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Participant.
 */
final class ParticipantUpdateAction
{
    private JsonRenderer $jsonRenderer;

    private ParticipantUpdater $participantUpdater;

    /**
     * The constructor.
     *
     * @param JsonRenderer $jsonRenderer The renderer
     * @param ParticipantUpdater $participantUpdater The service
     */
    public function __construct(JsonRenderer $jsonRenderer, ParticipantUpdater $participantUpdater)
    {
        $this->jsonRenderer = $jsonRenderer;
        $this->participantUpdater = $participantUpdater;
    }

    /**
     * Participant.
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
        $participantId = (int)$args['participant_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->participantUpdater->updateParticipant($participantId, $data);

        // Build the HTTP response
        return $this->jsonRenderer->json($response);
    }
}
