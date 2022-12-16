<?php

namespace App\Action\Participant;

use App\Domain\Participant\Service\ParticipantDeleter;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Participant.
 */
final class ParticipantDeleteAction
{
    private ParticipantDeleter $participantDeleter;

    private JsonRenderer $renderer;

    /**
     * The constructor.
     *
     * @param ParticipantDeleter $participantDeleter The service
     * @param JsonRenderer $renderer The responder
     */
    public function __construct(ParticipantDeleter $participantDeleter, JsonRenderer $renderer)
    {
        $this->participantDeleter = $participantDeleter;
        $this->renderer = $renderer;
    }

    /**
     * Participant.
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
        $participantId = (int)$args['participant_id'];

        // Invoke the domain (service class)
        $this->participantDeleter->deleteParticipant($participantId);

        // Render the json response
        return $this->renderer->json($response);
    }
}
