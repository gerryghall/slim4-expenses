<?php

namespace App\Domain\Participant\Data;

/**
 * DTO.
 */
class ParticipantItem
{
    public ?int $id = null;

    public ?string $firstname = null;

    public ?string $lastname = null;

    public ?string $email = null;

    public function __construct(array $item = [])
    {
        $this->id = $item['id'];
        $this->firstname = $item['firstname'];
        $this->lastname = $item['lastname'];
        $this->email = $item['email'];

        return $this;
    }

    public function toRow(): array
    {
        $item = [];
        $item['id'] = $this->id;
        $item['firstname'] = $this->firstname;
        $item['lastname'] = $this->lastname;
        return $item;
    }
}
