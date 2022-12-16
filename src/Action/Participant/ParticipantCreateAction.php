<?php

namespace App\Action\Participant;

use App\Domain\Participant\Service\ParticipantCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Participant.
 */
final class ParticipantCreateAction
{
    private JsonRenderer $jsonRenderer;

    private ParticipantCreator $participantCreator;

    /**
     * The constructor.
     *
     * @param JsonRenderer $renderer The responder
     * @param ParticipantCreator $participantCreator The service
     */
    public function __construct(JsonRenderer $renderer, ParticipantCreator $participantCreator)
    {
        $this->jsonRenderer = $renderer;
        $this->participantCreator = $participantCreator;
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
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $participantId = $this->participantCreator->creatParticipant($data);

        // Build the HTTP response
        return $this->jsonRenderer
            ->json($response, ['participant_id' => $participantId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
