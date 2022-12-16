<?php

namespace App\Domain\Claim\Service;

use App\Domain\Claim\Repository\ClaimFinderRepository;
use App\Factory\ConstraintFactory;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class ClaimValidator
{
    private ClaimFinderRepository $repository;

    public function __construct(ClaimFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateClaimUpdate(int $claimId, array $data): void
    {
        if (!$this->repository->existsClaimId($claimId)) {
            throw new \DomainException(sprintf('Claim not found: %s', $claimId));
        }

        $this->validateClaim($data);
    }

    public function validateClaim(array $data): void
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
                'participant_id' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(10),
                    ]
                ),
                'claim_date' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->date(),
                    ]
                ),
                'visit_date' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->date(),
                    ]
                ),
                'site_number' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->positive(),
                    ]
                ),
                'study_reference' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->positive(),
                    ]
                ),
            ]
        );
    }

    private function searchConstraints(): Constraint
    {
        $constraint = new ConstraintFactory();

        return $constraint->collection(
            [
                'participant_id' => $constraint->optional(
                    [
                        $constraint->notBlank(),
                        $constraint->length(10),
                    ]
                ),
                'claim_date' => $constraint->optional(
                    [
                        $constraint->notBlank(),
                        $constraint->date(),
                    ]
                ),
                'visit_date' => $constraint->optional(
                    [
                        $constraint->notBlank(),
                        $constraint->date(),
                    ]
                ),
                'site_number' => $constraint->optional(
                    [
                        $constraint->notBlank(),
                        $constraint->positive(),
                    ]
                ),
                'study_reference' => $constraint->optional(
                    [
                        $constraint->notBlank(),
                        $constraint->positive(),
                    ]
                ),
            ]
        );
    }
}
