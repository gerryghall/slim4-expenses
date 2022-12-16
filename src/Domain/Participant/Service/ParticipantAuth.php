<?php

namespace App\Domain\Participant\Service;

use App\Domain\Participant\Repository\ParticipantRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use SocialConnect\Auth\Service;

final class ParticipantAuth
{

    private Service $authService;

    private LoggerInterface $logger;

    public function __construct(
           Service $authService,
            LoggerFactory $loggerFactory
    ) {
        $this->authService = $authService;

    }

    public function login(): array
    {
        $provider = $this->getProvider();

        $accessToken = $provider->getAccessTokenByRequestParameters($_GET);
        $user = $provider->getIdentity($accessToken);

        return [
                'accesstoken' => $accessToken,
                'user' => $user
        ];
    }
    public function getProvider($media = 'facebook') {
        return $this->authService->getProvider($media);
    }
}
