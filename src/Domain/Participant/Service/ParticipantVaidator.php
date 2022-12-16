<?php

namespace App\Domain\Participant\Service;

use App\Domain\Participant\Repository\ParticipantRepository;
use App\Factory\ConstraintFactory;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class ParticipantVaidator
{
    private ParticipantRepository $repository;

    public function __construct(ParticipantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateParticipantUpdate(int $participantId, array $data): void
    {
        if (!$this->repository->existsParticipantId($participantId)) {
            throw new \DomainException(sprintf('Participant not found: %s', $participantId));
        }

        $this->validateParticipant($data);
    }

    public function validateParticipant(array $data): void
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($data, $this->createConstraints());

        if ($violations->count()) {
            throw new ValidationFailedException('Please check your input', $violations);
        }
    }

    private function createConstraints(): Constraint
    {
        $constraint = new ConstraintFactory();

        return $constraint->collection(
            [
                'firstname' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 255),
                    ]
                ),
                'lastname' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 255),
                    ]
                ),
                'eamil' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->email(),
                        $constraint->length(null, 254)
                    ]
                ),
            ]
        );
    }
}
