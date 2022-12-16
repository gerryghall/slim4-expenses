<?php

namespace App\Domain\Expense\Service;

use App\Domain\Expense\Repository\ExpenseRepository;
use App\Factory\ConstraintFactory;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class ExpenseVaidator
{
    private ExpenseRepository $repository;

    public function __construct(ExpenseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateExpenseUpdate(int $expenseId, array $data): void
    {
        if (!$this->repository->existsExpenseId($expenseId)) {
            throw new \DomainException(sprintf('Expense not found: %s', $expenseId));
        }

        $this->validateExpense($data);
    }

    public function validateExpense(array $data): void
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
                'typw' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                    ]
                ),
                'amount' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                    ]
                ),
                'unit_type' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                    ]
                ),
                'claim_id' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                    ]
                ),
            ]
        );
    }
}
