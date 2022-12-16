<?php

namespace App\Domain\Expense\Data;

/**
 * DTO.
 */
class ExpenseItem
{
    public ?int $id = null;

    public ?string $amount = null;

    public ?string $type = null;
    protected ?int $typeId = null;

    public ?string $unit = null;
    protected ?int $unitType = null;

    public ?string $reference = null;
    public ?int $claimId = null;

    public ?string $additionalInformation = null;

    public function __construct(array $expense)
    {
        $this->id = $expense['id'];
        $this->type = $expense['type'];
        $this->amount = $expense['amount'];
        $this->unit = $expense['unit_type'];
        $this->reference = $expense['reference'];
        $this->additionalInformation = $expense['additional_information'];

        return $this;
    }

    public function toRow(): array
    {
        $expense = [];
        $expense['type'] = $this->typeId;
        $expense['amount'] = $this->amount;
        $expense['unit_type'] = $this->unitType;
        $expense['claim_id'] = $this->claimId;

        return $expense;
    }
}
