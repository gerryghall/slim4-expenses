<?php

namespace App\Action\Participant;

use App\Domain\Participant\Service\ParticipantAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ParticipantAuthAction
{
    private ParticipantAuth $userAuth;



    public function __construct(ParticipantAuth $userAuth)
    {
        $this->userAuth = $userAuth;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response

    ) {
        try {
            $provider = $this->userAuth->getProvider();
            header('Location: ' . $provider->makeAuthUrl());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        exit();
    }
}
