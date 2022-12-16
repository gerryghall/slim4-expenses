<?php

namespace App\Action\Participant;

use App\Domain\Participant\Data\ParticipantData;
use App\Domain\Participant\Service\ParticipantReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Participant.
 */
final class ParticipantReadAction
{
    private ParticipantReader $participantReader;

    private JsonRenderer $jsonRenderer;

    /**
     * The constructor.
     *
     * @param ParticipantReader $participantViewer The service
     * @param JsonRenderer $jsonRenderer The responder
     */
    public function __construct(ParticipantReader $participantViewer, JsonRenderer $jsonRenderer)
    {
        $this->participantReader = $participantViewer;
        $this->jsonRenderer = $jsonRenderer;
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
        $participant = $this->participantReader->getParticipantData($participantId);

        // Transform result
        return $this->transform($response, $participant);
    }

    /**
     * Transform result to response.
     *
     * @param ResponseInterface $response The response
     * @param ParticipantData $participant The participant
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, ParticipantData $participant): ResponseInterface
    {
        // Turn that object into a structured array
        $data = [
            'id' => $participant->id,
            'participantname' => $participant->participantname,
            'first_name' => $participant->firstName,
            'last_name' => $participant->lastName,
            'email' => $participant->email,
            'participant_role_id' => $participant->participantRoleId,
            'locale' => $participant->locale,
            'enabled' => $participant->enabled,
        ];

        // Turn all of that into a JSON string and put it into the response body
        return $this->jsonRenderer->json($response, $data);
    }
}
