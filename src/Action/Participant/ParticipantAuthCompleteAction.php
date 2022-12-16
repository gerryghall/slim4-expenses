<?php

namespace App\Action\Participant;

use App\Domain\Participant\Service\ParticipantUpatder;
use App\Domain\Participant\Service\ParticipantAuth;
use App\Renderer\JsonRenderer;
use App\Renderer\RedirectRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ParticipantAuthCompleteAction
{
    private ParticipantAuth $userAuth;
    private RedirectRenderer $redirectRenderer;


    public function __construct(ParticipantAuth $userAuth, RedirectRenderer $redirectRenderer)
    {
        $this->userAuth = $userAuth;
        $this->redirectRenderer = $redirectRenderer;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response
    ) {
        if ($this->userAuth->login()) {
            return $this->redirectRenderer->redirect($response, '/index.html');
        }
    }
}
