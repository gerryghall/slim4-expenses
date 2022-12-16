<?php

namespace App\Domain\Expense\Data;

/**
 * DTO.
 */
class ExpenseDataItem
{
    public ?int $id = null;

    public ?string $name = null;

    public function __construct(array $expense = [])
    {
        $this->id = $expense['id'];
        $this->name = $expense['name'];

        return $this;
    }
}
